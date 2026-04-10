document.addEventListener('DOMContentLoaded',()=>{const root=document.querySelector('.gallery');if(!root)return;const track=root.querySelector('.gallery-track');const slides=Array.from(root.querySelectorAll('.gallery-slide'));const prevBtn=root.querySelector('.gallery-btn.prev');const nextBtn=root.querySelector('.gallery-btn.next');const dotsWrap=root.querySelector('.gallery-dots');let index=0;const dots=slides.map((_,i)=>{const b=document.createElement('button');b.type='button';b.className='gallery-dot';b.setAttribute('aria-label',`写真 ${i+1}を表示`);
    b.addEventListener('click', () => go(i));
    dotsWrap.appendChild(b);
    return b;
  });

  const clamp = (n) => Math.max(0, Math.min(slides.length - 1, n));

  function update() {
    track.style.transform = `translateX(${-index*100}%)`;
    dots.forEach((d, i) => d.classList.toggle('is-active', i === index));
    prevBtn.disabled = index === 0;
    nextBtn.disabled = index === slides.length - 1;
  }

  function go(i) {
    index = clamp(i);
    update();
  }

  prevBtn.addEventListener('click', () => go(index - 1));
  nextBtn.addEventListener('click', () => go(index + 1));

  let startX = 0;
  let active = false;
  const viewport = root.querySelector('.gallery-viewport');
  viewport.addEventListener('touchstart', (e) => {
    if (!e.touches || e.touches.length !== 1) return;
    active = true;
    startX = e.touches[0].clientX;
  }, { passive: true });

  viewport.addEventListener('touchend', (e) => {
    if (!active) return;
    active = false;
    const endX = (e.changedTouches && e.changedTouches[0]) ? e.changedTouches[0].clientX : startX;
    const diff = endX - startX;
    if (Math.abs(diff) < 35) return;
    if (diff > 0) go(index - 1);
    else go(index + 1);
  }, { passive: true });

  root.addEventListener('keydown', (e) => {
    if (e.key === 'ArrowLeft') go(index - 1);
    if (e.key === 'ArrowRight') go(index + 1);
  });

  update();
});
