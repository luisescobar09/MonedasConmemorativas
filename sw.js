const staticCacheName = 'site-static-v1';
const dynamicCacheName = 'site-dynamic-v1';
const imageCacheName = 'site-images-v1';


const BASE_URL = 'https://monedas-conmemorativas.herokuapp.com';
const assets = [
  BASE_URL + '/',
  BASE_URL + '/index.html',
  BASE_URL + '/js/app.js',
  BASE_URL + '/js/ui.js',
  BASE_URL + '/js/materialize.min.js',
  BASE_URL + '/js/monedas.js',
  BASE_URL + '/css/styles.css',
  BASE_URL + '/css/materialize.min.css',
  BASE_URL + '/images/bicentenario_pf.png',
  'https://fonts.googleapis.com/icon?family=Material+Icons',
  'https://fonts.gstatic.com/s/materialicons/v47/flUhRq6tzZclQEJ-Vdg-IuiaDsNcIhQ8tQ.woff2'
];

// install event
self.addEventListener('install', evt => {
  //console.log('service worker installed');
  evt.waitUntil(
    caches.open(staticCacheName).then((cache) => {
      console.log('caching shell assets');
      cache.addAll(assets);
    })
  );
});

// activate event
self.addEventListener('activate', evt => {
  //console.log('service worker activated');
  evt.waitUntil(
    caches.keys().then(keys => {
      //console.log(keys);
      return Promise.all(keys
        .filter(key => key !== staticCacheName && key !== dynamicCacheName)
        .map(key => caches.delete(key))
      );
    })
  );
});

// fetch event
self.addEventListener('fetch', evt => {
  //console.log('fetch event', evt);
  evt.respondWith(
    caches.match(evt.request).then(cacheRes => {
      return cacheRes || fetch(evt.request).then(fetchRes => {
        return caches.open(dynamicCacheName).then(cache => {
          cache.put(evt.request.url, fetchRes.clone());
          return fetchRes;
        })
      });
    })
  );
});