//ハンドクリーム
window.addEventListener('load', function () {
  const slides = document.querySelectorAll('#graphic ul li');
  let current = 0;

  setInterval(function () {
    slides[current].classList.remove('now');
    current = (current + 1) % slides.length;
    slides[current].classList.add('now');
  }, 2500);
});