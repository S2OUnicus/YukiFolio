//scroll
const items = document.querySelectorAll('.slide-right, .slide-left');
window.addEventListener('scroll', () => {
	const trigger = window.innerHeight * 0.85;
	items.forEach(item => {
		const top = item.getBoundingClientRect().top;
		if (top < trigger) {
			item.classList.add('show');
		}
	});
});
