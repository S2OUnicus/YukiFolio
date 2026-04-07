// topにもどる
(() => {
	const cat = document.getElementById('peekCat');
	const stage = document.getElementById('stage');
	if (!cat || !stage) return;

	const SHOW_AT = 220;

	const update = () => {
		const y = stage.scrollTop || 0;

		if (y >= SHOW_AT) {
			cat.classList.add('is-show');
		} else {
			cat.classList.remove('is-show');
		}
	};

	update();

	let ticking = false;
	stage.addEventListener('scroll', () => {
		if (ticking) return;
		ticking = true;

		requestAnimationFrame(() => {
			update();
			ticking = false;
		});
	}, {
		passive: true
	});

	window.addEventListener('resize', update);

	const goTop = () => {
		stage.scrollTo({
			top: 0,
			behavior: 'smooth'
		});
	};

	cat.addEventListener('click', goTop);
	cat.addEventListener('keydown', (e) => {
		if (e.key === 'Enter' || e.key === ' ') {
			e.preventDefault();
			goTop();
		}
	});
})();