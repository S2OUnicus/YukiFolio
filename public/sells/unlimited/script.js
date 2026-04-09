const menuToggle = document.querySelector('.menu-toggle');
const globalNav = document.querySelector('.global-nav');
const navLinks = document.querySelectorAll('.global-nav a');
const revealTargets = document.querySelectorAll('.reveal');
const modal = document.getElementById('poster-modal');
const openModalButton = document.querySelector('[data-open-modal]');
const closeModalButtons = document.querySelectorAll('[data-close-modal]');
const placeholderLink = document.querySelector('[data-placeholder-link]');
const yearTarget = document.getElementById('current-year');

if (yearTarget) {
  yearTarget.textContent = new Date().getFullYear();
}

if (menuToggle && globalNav) {
  menuToggle.addEventListener('click', () => {
    const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';
    menuToggle.setAttribute('aria-expanded', String(!isExpanded));
    globalNav.classList.toggle('is-open');
  });

  navLinks.forEach((link) => {
    link.addEventListener('click', () => {
      menuToggle.setAttribute('aria-expanded', 'false');
      globalNav.classList.remove('is-open');
    });
  });
}

if ('IntersectionObserver' in window) {
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          observer.unobserve(entry.target);
        }
      });
    },
    {
      threshold: 0.12,
    }
  );

  revealTargets.forEach((target) => observer.observe(target));
} else {
  revealTargets.forEach((target) => target.classList.add('is-visible'));
}

const openModal = () => {
  if (!modal) return;
  modal.classList.add('is-open');
  modal.setAttribute('aria-hidden', 'false');
  document.body.classList.add('is-locked');
};

const closeModal = () => {
  if (!modal) return;
  modal.classList.remove('is-open');
  modal.setAttribute('aria-hidden', 'true');
  document.body.classList.remove('is-locked');
};

if (openModalButton) {
  openModalButton.addEventListener('click', openModal);
}

closeModalButtons.forEach((button) => {
  button.addEventListener('click', closeModal);
});

window.addEventListener('keydown', (event) => {
  if (event.key === 'Escape') {
    closeModal();
  }
});

if (placeholderLink) {
  placeholderLink.addEventListener('click', (event) => {
    event.preventDefault();
    window.alert('ご参加いただきありがとうございました！');
  });
}
