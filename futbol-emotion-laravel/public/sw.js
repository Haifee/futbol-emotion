// Service worker mínimo para que la app sea instalable
const CACHE_NAME = 'futbol-emotion-v1';

self.addEventListener('install', (event) => {
  self.skipWaiting();
});

self.addEventListener('activate', (event) => {
  event.waitUntil(self.clients.claim());
});

// Deja pasar todas las peticiones directo a la red
// (los datos siempre deben venir frescos del servidor)
self.addEventListener('fetch', (event) => {
  event.respondWith(fetch(event.request));
});
