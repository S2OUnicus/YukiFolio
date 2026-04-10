(() => {
  const config = window.__PWA_CONFIG__ || {};
  const swPath = config.swPath || './service-worker.js';
  const isStandalone = () => window.matchMedia('(display-mode: standalone)').matches || window.navigator.standalone === true;

  const installButton = document.createElement('button');
  installButton.className = 'pwa-install-button';
  installButton.hidden = true;
  installButton.type = 'button';
  installButton.textContent = 'アプリをインストール';

  const toast = document.createElement('section');
  toast.className = 'pwa-update-toast';
  toast.hidden = true;
  toast.innerHTML = [
    '<div class="pwa-update-title">新しいバージョンがあります</div>',
    '<div class="pwa-update-text">更新すると最新のページとキャッシュに切り替わります。</div>',
    '<div class="pwa-update-actions">',
    '  <button type="button" class="pwa-update-primary" data-pwa-update>更新する</button>',
    '  <button type="button" class="pwa-update-secondary" data-pwa-dismiss>あとで</button>',
    '</div>'
  ].join('');

  const appendUi = () => {
    if (!document.body) return;
    if (!document.body.contains(installButton)) document.body.appendChild(installButton);
    if (!document.body.contains(toast)) document.body.appendChild(toast);
  };

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', appendUi, { once: true });
  } else {
    appendUi();
  }

  let deferredPrompt = null;
  let pendingWorker = null;
  let refreshing = false;

  const showInstall = () => {
    installButton.hidden = isStandalone() || !deferredPrompt;
  };

  const hideInstall = () => {
    installButton.hidden = true;
  };

  const showUpdateToast = (worker) => {
    pendingWorker = worker;
    toast.hidden = false;
  };

  const hideUpdateToast = () => {
    toast.hidden = true;
  };

  installButton.addEventListener('click', async () => {
    if (!deferredPrompt) return;
    deferredPrompt.prompt();
    try {
      await deferredPrompt.userChoice;
    } catch (error) {
      // noop
    }
    deferredPrompt = null;
    hideInstall();
  });

  toast.addEventListener('click', (event) => {
    const target = event.target;
    if (!(target instanceof HTMLElement)) return;

    if (target.matches('[data-pwa-update]')) {
      if (pendingWorker) {
        pendingWorker.postMessage({ type: 'SKIP_WAITING' });
      }
      hideUpdateToast();
    }

    if (target.matches('[data-pwa-dismiss]')) {
      hideUpdateToast();
    }
  });

  window.addEventListener('beforeinstallprompt', (event) => {
    event.preventDefault();
    deferredPrompt = event;
    showInstall();
  });

  window.addEventListener('appinstalled', () => {
    deferredPrompt = null;
    hideInstall();
  });

  window.addEventListener('load', async () => {
    showInstall();

    if (!('serviceWorker' in navigator)) return;

    try {
      const registration = await navigator.serviceWorker.register(swPath);

      navigator.serviceWorker.addEventListener('controllerchange', () => {
        if (refreshing) return;
        refreshing = true;
        window.location.reload();
      });

      if (registration.waiting) {
        showUpdateToast(registration.waiting);
      }

      registration.addEventListener('updatefound', () => {
        const newWorker = registration.installing;
        if (!newWorker) return;
        newWorker.addEventListener('statechange', () => {
          if (newWorker.state === 'installed' && navigator.serviceWorker.controller) {
            showUpdateToast(newWorker);
          }
        });
      });
    } catch (error) {
      console.warn('[PWA] Service Worker registration failed.', error);
    }
  }, { once: true });
})();
