// topにもどる
(() => {
	'use strict';

	const cat = document.getElementById('peekCat');
	const catImg = document.getElementById('peekCatImage');
	const catTip = document.getElementById('peekCatTip');
	const stage = document.getElementById('stage');

	if (!cat || !catImg || !catTip || !stage) {
		console.warn('[Return-to-top] 必要な要素が見つかりません');
		return;
	}

	const SHOW_AT = 220;
	const ALPHA_THRESHOLD = 16;

	let ticking = false;
	let hitCanvas = null;
	let hitCtx = null;
	let hitReady = false;

	const clamp = (value, min, max) => Math.min(Math.max(value, min), max);

	const update = () => {
		const y = Number(stage.scrollTop) || 0;
		cat.classList.toggle('is-show', y >= SHOW_AT);
	};

	const buildHitMap = () => {
		if (!catImg.complete || !catImg.naturalWidth || !catImg.naturalHeight) {
			return false;
		}

		try {
			hitCanvas = document.createElement('canvas');
			hitCanvas.width = catImg.naturalWidth;
			hitCanvas.height = catImg.naturalHeight;

			hitCtx = hitCanvas.getContext('2d', { willReadFrequently: true });
			if (!hitCtx) return false;

			hitCtx.clearRect(0, 0, hitCanvas.width, hitCanvas.height);
			hitCtx.drawImage(catImg, 0, 0);

			hitReady = true;
			return true;
		} catch (error) {
			console.warn('[Return-to-top] ヒットマップ作成失敗', error);
			hitReady = false;
			return false;
		}
	};

	const isOpaqueAtClientPoint = (clientX, clientY) => {
		const rect = catImg.getBoundingClientRect();

		if (
			clientX < rect.left ||
			clientX > rect.right ||
			clientY < rect.top ||
			clientY > rect.bottom
		) {
			return false;
		}

		/* 画像判定が作れなかった場合の安全フォールバック
		   この場合は画像の矩形全体をクリック可にする */
		if (!hitReady || !hitCtx || !hitCanvas) {
			return true;
		}

		const x = clamp(
			Math.floor((clientX - rect.left) * (catImg.naturalWidth / rect.width)),
			0,
			hitCanvas.width - 1
		);

		const y = clamp(
			Math.floor((clientY - rect.top) * (catImg.naturalHeight / rect.height)),
			0,
			hitCanvas.height - 1
		);

		try {
			const alpha = hitCtx.getImageData(x, y, 1, 1).data[3];
			return alpha > ALPHA_THRESHOLD;
		} catch (error) {
			console.warn('[Return-to-top] 透明判定失敗', error);
			return true;
		}
	};

	const goTop = () => {
		try {
			if (typeof stage.scrollTo === 'function') {
				stage.scrollTo({
					top: 0,
					behavior: 'smooth'
				});
			} else {
				stage.scrollTop = 0;
			}
		} catch (error) {
			console.warn('[Return-to-top] scrollTo失敗', error);
			stage.scrollTop = 0;
		}
	};

	const onPointerMove = (e) => {
		if (!cat.classList.contains('is-show')) {
			cat.dataset.hit = 'outside';
			return;
		}

		const rect = catImg.getBoundingClientRect();
		const insideBox =
			e.clientX >= rect.left &&
			e.clientX <= rect.right &&
			e.clientY >= rect.top &&
			e.clientY <= rect.bottom;

		if (!insideBox) {
			cat.dataset.hit = 'outside';
			return;
		}

		cat.dataset.hit = isOpaqueAtClientPoint(e.clientX, e.clientY)
			? 'opaque'
			: 'transparent';
	};

	const onCatClick = (e) => {
		if (!isOpaqueAtClientPoint(e.clientX, e.clientY)) {
			return;
		}
		goTop();
	};

	const onCatKeydown = (e) => {
		if (e.key === 'Enter' || e.key === ' ') {
			e.preventDefault();
			goTop();
		}
	};

	update();

	if (!buildHitMap()) {
		catImg.addEventListener('load', buildHitMap, { once: true });
		catImg.addEventListener('error', () => {
			console.warn('[Return-to-top] 画像の読み込みに失敗しました');
		}, { once: true });
	}

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

	window.addEventListener('resize', update, { passive: true });
	document.addEventListener('pointermove', onPointerMove, { passive: true });

	catImg.addEventListener('click', onCatClick);
	catImg.addEventListener('keydown', onCatKeydown);
	catTip.addEventListener('click', goTop);
})();