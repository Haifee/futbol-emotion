// Service worker de Fútbol Emotion — instalable + notificaciones push
const CACHE_NAME = 'futbol-emotion-v2';

self.addEventListener('install', (event) => {
  self.skipWaiting();
});

self.addEventListener('activate', (event) => {
  event.waitUntil(self.clients.claim());
});

// Deja pasar todas las peticiones directo a la red (datos siempre frescos)
self.addEventListener('fetch', (event) => {
  event.respondWith(fetch(event.request));
});

// ── Notificaciones push ──
self.addEventListener('push', (event) => {
  let data = { title: 'Fútbol Emotion', body: 'Tienes una novedad' };
  try {
    if (event.data) data = event.data.json();
  } catch (e) {
    if (event.data) data.body = event.data.text();
  }

  const options = {
    body: data.body || '',
    icon: data.icon || '/icon-192.png',
    badge: data.badge || '/icon-192.png',
    vibrate: [90, 40, 90],
    tag: data.tag || 'futbol-emotion',
    renotify: true,
    data: { url: data.url || '/' },
  };

  event.waitUntil(
    self.registration.showNotification(data.title || 'Fútbol Emotion', options)
  );
});

// Al tocar la notificación, abrir/enfocar la app
self.addEventListener('notificationclick', (event) => {
  event.notification.close();
  const url = (event.notification.data && event.notification.data.url) || '/';
  event.waitUntil(
    self.clients.matchAll({ type: 'window', includeUncontrolled: true }).then((clientsArr) => {
      for (const client of clientsArr) {
        if ('focus' in client) return client.focus();
      }
      if (self.clients.openWindow) return self.clients.openWindow(url);
    })
  );
});
