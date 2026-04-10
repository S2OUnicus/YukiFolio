const STATIC_CACHE = 'yukino-static-v3';
const RUNTIME_CACHE = 'yukino-runtime-v3';
const OFFLINE_URL = './offline.html';

const PRECACHE_URLS = [
  "./",
  "./FAQ.html",
  "./common/404.html",
  "./contact.html",
  "./css/404.css",
  "./css/base.css",
  "./css/main_contact.css",
  "./css/main_faq.css",
  "./css/main_gallery.css",
  "./css/main_index.css",
  "./css/main_profile.css",
  "./css/portfolio.css",
  "./css/pwa-ui.css",
  "./css/work_detail.css",
  "./css/work_no.css",
  "./external/KleeOne-Regular.woff2",
  "./external/jquery.min.js",
  "./external/pdf.min.js",
  "./external/slick.css",
  "./external/slick.min.js",
  "./external/three.min.js",
  "./external/uikit-icons.min.js",
  "./external/uikit.min.css",
  "./external/uikit.min.js",
  "./favicon.ico",
  "./gallery.html",
  "./game/diffcat.html",
  "./image/gallery/1.png",
  "./image/gallery/10.png",
  "./image/gallery/11.png",
  "./image/gallery/12.png",
  "./image/gallery/13.png",
  "./image/gallery/14.png",
  "./image/gallery/2.png",
  "./image/gallery/3.png",
  "./image/gallery/4.png",
  "./image/gallery/5.png",
  "./image/gallery/6.png",
  "./image/gallery/7.png",
  "./image/gallery/8.png",
  "./image/gallery/9.png",
  "./image/icons/apple-touch-icon.png",
  "./image/icons/icon-192.png",
  "./image/icons/icon-512.png",
  "./image/icons/icon-maskable-512.png",
  "./image/materiaru/SAMPLE.png",
  "./image/materiaru/backgraund.jpg",
  "./image/materiaru/kinonya.png",
  "./image/materiaru/logo-main.png",
  "./image/materiaru/logo.png",
  "./image/others/#U540d#U79f0#U672a#U8a2d#U5b9a (50 x 50 px) (1).png",
  "./image/others/JIMCHI.png",
  "./image/others/LINE-stamp.png",
  "./image/others/exhibition.jpg",
  "./image/others/portfolio.png",
  "./image/others/profile.png",
  "./image/others/spot-the-difference.png",
  "./image/poster/grapes.jpg",
  "./image/poster/lemon.jpg",
  "./image/poster/peach.jpg",
  "./image/poster/strawberry.jpg",
  "./image/season/autumn.png",
  "./image/season/spring.png",
  "./image/season/summer.png",
  "./image/season/winter.png",
  "./image/slide/slide1.png",
  "./image/slide/slide2.png",
  "./image/slide/slide3.png",
  "./image/slide/slide4.png",
  "./image/top/1.png",
  "./image/top/10.png",
  "./image/top/11.png",
  "./image/top/12.png",
  "./image/top/13.png",
  "./image/top/14.png",
  "./image/top/2.png",
  "./image/top/3.png",
  "./image/top/4.png",
  "./image/top/5.png",
  "./image/top/6.png",
  "./image/top/7.png",
  "./image/top/8.png",
  "./image/top/9.png",
  "./index.html",
  "./js/Return-to-top.js",
  "./js/p_faq.js",
  "./js/p_index.js",
  "./js/p_portfolio.js",
  "./js/p_profile.js",
  "./js/pwa-enhancements.js",
  "./js/slick.js",
  "./js/slideshow.js",
  "./manifest.webmanifest",
  "./offline.html",
  "./portfolio.html",
  "./profile.html",
  "./sells/handcream/assets/3.png",
  "./sells/handcream/assets/6.png",
  "./sells/handcream/assets/7.png",
  "./sells/handcream/assets/8.png",
  "./sells/handcream/base.css",
  "./sells/handcream/base.js",
  "./sells/handcream/index.html",
  "./sells/unlimited/exhibition.jpg",
  "./sells/unlimited/index.html",
  "./sells/unlimited/script.js",
  "./sells/unlimited/style.css",
  "./standalone/JIMUCTI/access.html",
  "./standalone/JIMUCTI/concept.html",
  "./standalone/JIMUCTI/css/access.css",
  "./standalone/JIMUCTI/css/concept.css",
  "./standalone/JIMUCTI/css/loader.css",
  "./standalone/JIMUCTI/css/menu.css",
  "./standalone/JIMUCTI/css/news.css",
  "./standalone/JIMUCTI/css/style.css",
  "./standalone/JIMUCTI/image/JIMCHI/JIMCHI.png",
  "./standalone/JIMUCTI/image/JIMCHI/favicon.png",
  "./standalone/JIMUCTI/image/JIMCHI/logo.png",
  "./standalone/JIMUCTI/image/JIMCHI/reservation.png",
  "./standalone/JIMUCTI/image/JIMCHI.png",
  "./standalone/JIMUCTI/image/Main/1.png",
  "./standalone/JIMUCTI/image/Main/2.png",
  "./standalone/JIMUCTI/image/Main/3.png",
  "./standalone/JIMUCTI/image/Main/4.png",
  "./standalone/JIMUCTI/image/Main/5.png",
  "./standalone/JIMUCTI/image/Main/6.png",
  "./standalone/JIMUCTI/image/Main/7.png",
  "./standalone/JIMUCTI/image/Main/8.png",
  "./standalone/JIMUCTI/image/Main/9.png",
  "./standalone/JIMUCTI/image/concept/1.png",
  "./standalone/JIMUCTI/image/concept/2.jpg",
  "./standalone/JIMUCTI/image/concept/3.jpg",
  "./standalone/JIMUCTI/image/concept/4.png",
  "./standalone/JIMUCTI/image/menu/meat/menu1.png",
  "./standalone/JIMUCTI/image/menu/meat/menu10.jpg",
  "./standalone/JIMUCTI/image/menu/meat/menu11.jpg",
  "./standalone/JIMUCTI/image/menu/meat/menu12.jpg",
  "./standalone/JIMUCTI/image/menu/meat/menu13.jpg",
  "./standalone/JIMUCTI/image/menu/meat/menu14.png",
  "./standalone/JIMUCTI/image/menu/meat/menu15.png",
  "./standalone/JIMUCTI/image/menu/meat/menu2.jpg",
  "./standalone/JIMUCTI/image/menu/meat/menu3.jpg",
  "./standalone/JIMUCTI/image/menu/meat/menu4.jpg",
  "./standalone/JIMUCTI/image/menu/meat/menu5.jpg",
  "./standalone/JIMUCTI/image/menu/meat/menu6.jpg",
  "./standalone/JIMUCTI/image/menu/meat/menu7.jpg",
  "./standalone/JIMUCTI/image/menu/meat/menu8.jpg",
  "./standalone/JIMUCTI/image/menu/meat/menu9.jpg",
  "./standalone/JIMUCTI/image/menu/soup/1.png",
  "./standalone/JIMUCTI/image/menu/soup/2.png",
  "./standalone/JIMUCTI/image/menu/soup/3.png",
  "./standalone/JIMUCTI/image/menu/soup/4.png",
  "./standalone/JIMUCTI/image/menu/soup/5.png",
  "./standalone/JIMUCTI/image/menu/soup/6.jpg",
  "./standalone/JIMUCTI/image/menu/soup/7.jpg",
  "./standalone/JIMUCTI/image/menu/soup/8.jpg",
  "./standalone/JIMUCTI/image/sample1.jpg",
  "./standalone/JIMUCTI/image/sample15.png",
  "./standalone/JIMUCTI/image/sample7.jpg",
  "./standalone/JIMUCTI/image/sample8.png",
  "./standalone/JIMUCTI/image/slider/1.png",
  "./standalone/JIMUCTI/image/slider/2.png",
  "./standalone/JIMUCTI/image/slider/3.png",
  "./standalone/JIMUCTI/index.html",
  "./standalone/JIMUCTI/js/access.js",
  "./standalone/JIMUCTI/js/concept.js",
  "./standalone/JIMUCTI/js/faq.js",
  "./standalone/JIMUCTI/js/gallery.js",
  "./standalone/JIMUCTI/js/home.js",
  "./standalone/JIMUCTI/js/jquery.min.js",
  "./standalone/JIMUCTI/js/loader.js",
  "./standalone/JIMUCTI/js/menu.js",
  "./standalone/JIMUCTI/js/news.js",
  "./standalone/JIMUCTI/loader.html",
  "./standalone/JIMUCTI/menu.html",
  "./standalone/JIMUCTI/menu1.html",
  "./standalone/JIMUCTI/menu2.html",
  "./standalone/JIMUCTI/menu3.html",
  "./standalone/JIMUCTI/news.html",
  "./standalone/PDF/portfolio.pdf",
  "./standalone/game/diffcat.html",
  "./work/1.html",
  "./work/10.html",
  "./work/11.html",
  "./work/12.html",
  "./work/13.html",
  "./work/14.html",
  "./work/2.html",
  "./work/3.html",
  "./work/4.html",
  "./work/5.html",
  "./work/6.html",
  "./work/7.html",
  "./work/8.html",
  "./work/9.html",
  "./work/common/nowork.html",
  "./work/index.html"
];

self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(STATIC_CACHE)
      .then((cache) => cache.addAll(PRECACHE_URLS))
      .then(() => self.skipWaiting())
  );
});

self.addEventListener('activate', (event) => {
  event.waitUntil((async () => {
    if ('navigationPreload' in self.registration) {
      try {
        await self.registration.navigationPreload.enable();
      } catch (error) {
        console.warn('Navigation preload enable failed:', error);
      }
    }

    const keys = await caches.keys();
    await Promise.all(
      keys
        .filter((key) => ![STATIC_CACHE, RUNTIME_CACHE].includes(key))
        .map((key) => caches.delete(key))
    );

    await self.clients.claim();
  })());
});

self.addEventListener('message', (event) => {
  if (event.data && event.data.type === 'SKIP_WAITING') {
    self.skipWaiting();
  }
});

self.addEventListener('fetch', (event) => {
  const request = event.request;

  if (request.method !== 'GET') return;

  const url = new URL(request.url);
  if (url.origin !== self.location.origin) return;

  if (request.mode === 'navigate') {
    event.respondWith(networkFirstPage(request, event));
    return;
  }

  if (['style', 'script', 'worker', 'font', 'image'].includes(request.destination)) {
    event.respondWith(staleWhileRevalidate(request));
    return;
  }

  event.respondWith(cacheFirst(request));
});

async function networkFirstPage(request, event) {
  const cache = await caches.open(RUNTIME_CACHE);
  try {
    const preloadResponse = await event.preloadResponse;
    if (preloadResponse) {
      cache.put(request, preloadResponse.clone());
      return preloadResponse;
    }

    const fresh = await fetch(request);
    if (fresh && fresh.ok) {
      cache.put(request, fresh.clone());
    }
    return fresh;
  } catch (error) {
    const cached = await cache.match(request, { ignoreSearch: true });
    return cached || caches.match(OFFLINE_URL, { ignoreSearch: true });
  }
}

async function staleWhileRevalidate(request) {
  const cache = await caches.open(RUNTIME_CACHE);
  const cached = await cache.match(request, { ignoreSearch: true });
  const networkFetch = fetch(request)
    .then((response) => {
      if (response && response.ok) {
        cache.put(request, response.clone());
      }
      return response;
    })
    .catch(() => undefined);

  return cached || networkFetch || cache.match(OFFLINE_URL, { ignoreSearch: true });
}

async function cacheFirst(request) {
  const cached = await caches.match(request, { ignoreSearch: true });
  if (cached) return cached;

  try {
    const response = await fetch(request);
    if (response && response.ok) {
      const cache = await caches.open(RUNTIME_CACHE);
      cache.put(request, response.clone());
    }
    return response;
  } catch (error) {
    if (request.destination === 'document') {
      return caches.match(OFFLINE_URL, { ignoreSearch: true });
    }
    throw error;
  }
}
