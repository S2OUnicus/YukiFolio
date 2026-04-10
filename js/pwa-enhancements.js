(() => {
  const scriptEl = document.currentScript || document.querySelector('script[data-pwa-root]');
  const rootPath = scriptEl?.dataset?.pwaRoot || './';
  const swPath = `${rootPath}service-worker.js`;
  const installButtonId = 'pwa-install-button';
  const toastId = 'pwa-update-toast';
  let deferredPrompt = null;
  let refreshing = false;
  let toastVisible = false;

  function isStandalone() {
    return window.matchMedia('(display-mode: standalone)').matches || window.navigator.standalone === true;
  }

  function ensureInstallButton() {
    let button = document.getElementById(installButtonId);
    if (button) return button;

    button = document.createElement('button');
    button.id = installButtonId;
    button.className = 'pwa-install-button';
    button.type = 'button';
    button.hidden = true;
    button.setAttribute('aria-label', 'このサイトをインストール');
    button.textContent = 'アプリをインストール';
    document.body.appendChild(button);

    button.addEventListener('click', async () => {
      if (!deferredPrompt) return;
      button.disabled = true;
      try {
        deferredPrompt.prompt();
        await deferredPrompt.userChoice;
      } catch (error) {
        console.error('Install prompt failed:', error);
      } finally {
        deferredPrompt = null;
        button.hidden = true;
        button.disabled = false;
      }
    });

    return button;
  }

  function ensureToast() {
    let toast = document.getElementById(toastId);
    if (toast) return toast;

    toast = document.createElement('section');
    toast.id = toastId;
    toast.className = 'pwa-toast';
    toast.hidden = true;
    toast.setAttribute('role', 'status');
    toast.setAttribute('aria-live', 'polite');
    toast.innerHTML = `
      <p class="pwa-toast__title">新しいバージョンがあります</p>
      <p class="pwa-toast__text">更新すると最新の内容へ切り替わります。</p>
      <div class="pwa-toast__actions">
        <button type="button" class="pwa-toast__button pwa-toast__button--primary" data-pwa-action="update">更新する</button>
        <button type="button" class="pwa-toast__button pwa-toast__button--secondary" data-pwa-action="dismiss">あとで</button>
      </div>
    `;
    document.body.appendChild(toast);
    return toast;
  }

  function showUpdateToast(registration) {
    if (!registration?.waiting || toastVisible) return;
    const toast = ensureToast();
    toast.hidden = false;
    toastVisible = true;

    const updateButton = toast.querySelector('[data-pwa-action="update"]');
    const dismissButton = toast.querySelector('[data-pwa-action="dismiss"]');

    updateButton.onclick = () => {
      updateButton.disabled = true;
      registration.waiting?.postMessage({ type: 'SKIP_WAITING' });
    };

    dismissButton.onclick = () => {
      toast.hidden = true;
      toastVisible = false;
    };
  }

  function setupInstallPrompt() {
    const installButton = ensureInstallButton();

    window.addEventListener('beforeinstallprompt', (event) => {
      event.preventDefault();
      deferredPrompt = event;
      if (!isStandalone()) {
        installButton.hidden = false;
      }
    });

    window.addEventListener('appinstalled', () => {
      deferredPrompt = null;
      installButton.hidden = true;
    });

    if (isStandalone()) {
      installButton.hidden = true;
    }
  }

  async function setupServiceWorker() {
    if (!('serviceWorker' in navigator)) return;

    try {
      const registration = await navigator.serviceWorker.register(swPath);

      navigator.serviceWorker.addEventListener('controllerchange', () => {
        if (refreshing) return;
        refreshing = true;
        window.location.reload();
      });

      if (registration.waiting) {
        showUpdateToast(registration);
      }

      registration.addEventListener('updatefound', () => {
        const newWorker = registration.installing;
        if (!newWorker) return;
        newWorker.addEventListener('statechange', () => {
          if (newWorker.state === 'installed' && navigator.serviceWorker.controller) {
            showUpdateToast(registration);
          }
        });
      });

      window.setInterval(() => {
        registration.update().catch(() => {});
      }, 30 * 60 * 1000);
    } catch (error) {
      console.error('Service Worker registration failed:', error);
    }
  }

  function init() {
    setupInstallPrompt();
    setupServiceWorker();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init, { once: true });
  } else {
    init();
  }
})();
