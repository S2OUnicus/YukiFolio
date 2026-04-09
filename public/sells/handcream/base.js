(() => {
	const revealTargets = document.querySelectorAll('.reveal');
	if ('IntersectionObserver' in window) {
		const observer = new IntersectionObserver((entries) => {
			for (const entry of entries) {
				if (entry.isIntersecting) entry.target.classList.add('is-visible');
			}
		}, {
			threshold: 0.18
		});
		document.querySelectorAll('.reveal:not(.is-visible)').forEach(el => observer.observe(el));
	} else {
		revealTargets.forEach((el) => el.classList.add('is-visible'));
	}

	function initShowcaseOrbit() {
		const stage = document.getElementById('showcase-stage');
		if (!stage) return;
		const items = Array.from(stage.querySelectorAll('.orbit-item'));
		if (items.length < 2) return;
		const prefersReducedMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
		const state = {
			rotation: 0,
			velocity: 0,
			pointerId: null,
			isDragging: false,
			startX: 0,
			lastX: 0,
			moved: 0,
			lastTime: 0
		};
		const step = (Math.PI * 2) / items.length;
		let rafId = 0;

		function clampLink(link) {
			try {
				const href = link.getAttribute('href') || '';
				if (!href || href.startsWith('javascript:')) {
					link.removeAttribute('href');
					return;
				}
				link.setAttribute('rel', 'noopener');
			} catch (error) {
				console.warn('link guard skipped', error);
			}
		}
		items.forEach(clampLink);

		function metrics() {
			const rect = stage.getBoundingClientRect();
			return {
				centerX: rect.width / 2,
				centerY: rect.height / 2,
				radiusX: Math.max(rect.width * 0.29, 78),
				radiusY: Math.max(rect.height * 0.16, 36)
			};
		}

		function render() {
			const {
				radiusX,
				radiusY
			} = metrics();
			items.forEach((item, index) => {
				const angle = state.rotation + (index * step) - Math.PI / 2;
				const depth = (Math.sin(angle) + 1) / 2;
				const x = Math.cos(angle) * radiusX;
				const y = Math.sin(angle) * radiusY;
				const scale = 0.72 + depth * 0.44;
				const opacity = 0.42 + depth * 0.58;
				const rotate = (x / Math.max(radiusX, 1)) * 10;
				item.style.transform = `translate(-50%, -50%) translate(${x.toFixed(2)}px, ${y.toFixed(2)}px) scale(${scale.toFixed(3)}) rotate(${rotate.toFixed(2)}deg)`;
				item.style.opacity = opacity.toFixed(3);
				item.style.zIndex = String(10 + Math.round(depth * 30));
				item.style.filter = `saturate(${(0.86 + depth * 0.26).toFixed(3)}) brightness(${(0.84 + depth * 0.22).toFixed(3)})`;
				if (depth > 0.92) {
					item.setAttribute('data-front', 'true');
				} else {
					item.removeAttribute('data-front');
				}
			});
		}

		function animate() {
			if (!state.isDragging && Math.abs(state.velocity) > 0.0001) {
				state.rotation += state.velocity;
				state.velocity *= prefersReducedMotion ? 0.82 : 0.94;
			} else if (!state.isDragging) {
				state.velocity = 0;
			}
			render();
			rafId = window.requestAnimationFrame(animate);
		}

		function updateRotation(deltaX, timestamp) {
			const deltaTime = Math.max(16, timestamp - (state.lastTime || timestamp));
			const rotationDelta = deltaX * 0.0085;
			state.rotation += rotationDelta;
			state.velocity = rotationDelta / deltaTime * 16;
			state.lastTime = timestamp;
			render();
		}

		function onPointerDown(event) {
			if (!(event instanceof PointerEvent)) return;
			if (event.pointerType === 'mouse' && event.button !== 0) return;
			state.pointerId = event.pointerId;
			state.isDragging = true;
			state.startX = event.clientX;
			state.lastX = event.clientX;
			state.moved = 0;
			state.velocity = 0;
			state.lastTime = event.timeStamp || performance.now();
			stage.classList.add('is-dragging');
			try {
				stage.setPointerCapture(event.pointerId);
			} catch (error) {
				/* ignore */
			}
		}

		function onPointerMove(event) {
			if (!state.isDragging || event.pointerId !== state.pointerId) return;
			const deltaX = event.clientX - state.lastX;
			state.lastX = event.clientX;
			state.moved += Math.abs(deltaX);
			updateRotation(deltaX, event.timeStamp || performance.now());
		}

		function onPointerUp(event) {
			if (!state.isDragging || event.pointerId !== state.pointerId) return;
			state.isDragging = false;
			stage.classList.remove('is-dragging');
			try {
				stage.releasePointerCapture(event.pointerId);
			} catch (error) {
				/* ignore */
			}
			state.pointerId = null;
		}
		stage.addEventListener('pointerdown', onPointerDown, {
			passive: true
		});
		stage.addEventListener('pointermove', onPointerMove, {
			passive: true
		});
		stage.addEventListener('pointerup', onPointerUp);
		stage.addEventListener('pointercancel', onPointerUp);
		stage.addEventListener('lostpointercapture', () => {
			state.isDragging = false;
			stage.classList.remove('is-dragging');
			state.pointerId = null;
		});
		stage.addEventListener('keydown', (event) => {
			if (event.key === 'ArrowLeft') {
				event.preventDefault();
				state.rotation -= step / 3;
				render();
			} else if (event.key === 'ArrowRight') {
				event.preventDefault();
				state.rotation += step / 3;
				render();
			}
		});
		items.forEach((item) => {
			item.addEventListener('click', (event) => {
				if (state.moved > 8) {
					event.preventDefault();
				}
			});
		});
		let resizeTimer = 0;
		window.addEventListener('resize', () => {
			window.clearTimeout(resizeTimer);
			resizeTimer = window.setTimeout(render, 60);
		}, {
			passive: true
		});
		render();
		animate();
		window.addEventListener('beforeunload', () => {
			if (rafId) cancelAnimationFrame(rafId);
		}, {
			once: true
		});
	}

	function initThreeBackground() {
		if (!window.THREE) return;
		const canvas = document.getElementById('hero-three');
		const hero = document.querySelector('.hero');
		if (!canvas || !hero) return;
		try {
			const renderer = new THREE.WebGLRenderer({
				canvas,
				alpha: true,
				antialias: true
			});
			renderer.setPixelRatio(Math.min(window.devicePixelRatio || 1, 1.6));
			const scene = new THREE.Scene();
			const camera = new THREE.PerspectiveCamera(50, 1, 0.1, 100);
			camera.position.z = 12;
			const group = new THREE.Group();
			scene.add(group);
			const spheres = [];
			const palette = [0xf8d8de, 0xf5c8cf, 0xd4c3ea, 0xf8efad, 0xd8e6d2, 0xefe7db];
			for (let i = 0; i < 42; i++) {
				const geo = new THREE.SphereGeometry(Math.random() * 0.18 + 0.05, 24, 24);
				const mat = new THREE.MeshBasicMaterial({
					color: palette[i % palette.length],
					transparent: true,
					opacity: Math.random() * 0.26 + 0.08
				});
				const mesh = new THREE.Mesh(geo, mat);
				mesh.position.set((Math.random() - 0.5) * 18, (Math.random() - 0.5) * 10, (Math.random() - 0.5) * 6);
				mesh.userData = {
					speed: Math.random() * 0.004 + 0.0015,
					drift: Math.random() * 0.003 + 0.001,
					angle: Math.random() * Math.PI * 2
				};
				group.add(mesh);
				spheres.push(mesh);
			}
			const softLight = new THREE.PointLight(0xffffff, 0.65, 100);
			softLight.position.set(0, 4, 12);
			scene.add(softLight);

			function resize() {
				const rect = hero.getBoundingClientRect();
				if (!rect.width || !rect.height) return;
				renderer.setSize(rect.width, rect.height, false);
				camera.aspect = rect.width / rect.height;
				camera.updateProjectionMatrix();
			}
			resize();
			window.addEventListener('resize', resize, {
				passive: true
			});
			let pointerX = 0;
			let pointerY = 0;
			window.addEventListener('pointermove', (e) => {
				pointerX = (e.clientX / Math.max(window.innerWidth, 1) - 0.5) * 0.8;
				pointerY = (e.clientY / Math.max(window.innerHeight, 1) - 0.5) * 0.6;
			}, {
				passive: true
			});
			const clock = new THREE.Clock();

			function tick() {
				const t = clock.getElapsedTime();
				group.rotation.y += (pointerX - group.rotation.y) * 0.02;
				group.rotation.x += (-pointerY - group.rotation.x) * 0.02;
				spheres.forEach((s, i) => {
					s.position.y += Math.sin(t + s.userData.angle + i) * s.userData.speed * 0.6;
					s.position.x += Math.cos(t * 0.8 + s.userData.angle) * s.userData.drift * 0.4;
					s.scale.setScalar(1 + Math.sin(t * 1.3 + i) * 0.08);
				});
				renderer.render(scene, camera);
				requestAnimationFrame(tick);
			}
			tick();
		} catch (error) {
			console.warn('three.js background skipped:', error);
		}
	}
	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', () => {
			initShowcaseOrbit();
			initThreeBackground();
		}, {
			once: true
		});
	} else {
		initShowcaseOrbit();
		initThreeBackground();
	}
})();
