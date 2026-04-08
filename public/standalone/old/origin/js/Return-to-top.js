// topにもどる
(() => {
  const cat = document.getElementById('peekCat');
  if (!cat) return;

  const SHOW_AT = 220;
  const update = () => {
    const y = window.scrollY || document.documentElement.scrollTop || 0;
    if (y >= SHOW_AT) {
      cat.classList.add('is-show');
    } else {
      cat.classList.remove('is-show');
    }
  };

  update();

  let ticking = false;
  window.addEventListener('scroll', () => {
    if (ticking) return;
    ticking = true;
    window.requestAnimationFrame(() => {
      update();
      ticking = false;
    });
  }, { passive: true });

  const goTop = () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  };

  cat.addEventListener('click', goTop);
  cat.addEventListener('keydown', (e) => {
    if (e.key === 'Enter' || e.key === ' ') {
      e.preventDefault();
      goTop();
    }
  });
})();
