const CACHE_VERSION = 'yukino-php-pwa-v20260410-1';
const STATIC_CACHE = `static-${CACHE_VERSION}`;
const PAGE_CACHE = `pages-${CACHE_VERSION}`;
const ASSET_CACHE = `assets-${CACHE_VERSION}`;
const OFFLINE_URL = './offline.html';
const PRECACHE_URLS = [
  "./",
  "./offline.html",
  "./manifest.webmanifest",
  "./FAQ.php",
  "./common/404.html",
  "./contact.php",
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
  "./favicon.ico",
  "./gallery.php",
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
  "./index.php",
  "./js/Return-to-top.js",
  "./js/p_faq.js",
  "./js/p_index.js",
  "./js/p_portfolio.js",
  "./js/p_profile.js",
  "./js/pwa-enhancements.js",
  "./js/slick.js",
  "./js/slideshow.js",
  "./portfolio.php",
  "./profile.php",
  "./sells/handcream/assets/3.png",
  "./sells/handcream/assets/6.png",
  "./sells/handcream/assets/7.png",
  "./sells/handcream/assets/8.png",
  "./sells/handcream/base.css",
  "./sells/handcream/base.js",
  "./sells/handcream/index.php",
  "./sells/unlimited/exhibition.jpg",
  "./sells/unlimited/index.php",
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
  "./standalone/game/diffcat.php",
  "./work/common/nowork.php",
  "./work/index.php"
];

self.addEventListener('install', (event) => {
  event.waitUntil((async () => {
    const cache = await caches.open(STATIC_CACHE);
    await cache.addAll(PRECACHE_URLS);
    await self.skipWaiting();
  })());
});

self.addEventListener('activate', (event) => {
  event.waitUntil((async () => {
    const keys = await caches.keys();
    await Promise.all(keys.filter((key) => ![STATIC_CACHE, PAGE_CACHE, ASSET_CACHE].includes(key)).map((key) => caches.delete(key)));
    await self.clients.claim();
  })());
});

self.addEventListener('message', (event) => {
  if (event.data && event.data.type === 'SKIP_WAITING') {
    self.skipWaiting();
  }
});

function isSameOrigin(url) {
  return url.origin === self.location.origin;
}

function isStaticAssetRequest(requestUrl, request) {
  if (['style', 'script', 'image', 'font', 'audio', 'video'].includes(request.destination)) return true;
  return /\.(?:css|js|mjs|png|jpg|jpeg|gif|svg|webp|ico|woff2?|ttf|otf|pdf|webmanifest)$/i.test(requestUrl.pathname);
}

function normalizedAssetKey(requestUrl) {
  const clean = new URL(requestUrl.href);
  if (isSameOrigin(clean)) {
    clean.search = '';
    clean.hash = '';
  }
  return clean.toString();
}

async function cacheFirstAsset(request) {
  const requestUrl = new URL(request.url);
  const key = normalizedAssetKey(requestUrl);
  const cache = await caches.open(ASSET_CACHE);
  const cached = await cache.match(key);
  if (cached) {
    fetch(request).then((response) => {
      if (response && response.ok) {
        cache.put(key, response.clone());
      }
    }).catch(() => {});
    return cached;
  }
  try {
    const response = await fetch(request);
    if (response && (response.ok || response.type === 'opaque')) {
      cache.put(key, response.clone());
    }
    return response;
  } catch (error) {
    return caches.match(key) || caches.match('./image/icons/icon-192.png');
  }
}

async function networkFirstPage(request) {
  const cache = await caches.open(PAGE_CACHE);
  try {
    const response = await fetch(request);
    if (response && response.ok) {
      cache.put(request, response.clone());
    }
    return response;
  } catch (error) {
    const cached = await cache.match(request);
    if (cached) return cached;
    return caches.match(OFFLINE_URL);
  }
}

self.addEventListener('fetch', (event) => {
  const request = event.request;
  if (request.method !== 'GET') return;

  const requestUrl = new URL(request.url);

  if (request.mode === 'navigate') {
    event.respondWith(networkFirstPage(request));
    return;
  }

  if (isStaticAssetRequest(requestUrl, request)) {
    event.respondWith(cacheFirstAsset(request));
  }
});
