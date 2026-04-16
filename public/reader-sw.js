// Lucide Inkt Reader – Service Worker
// Minimal SW required for PWA installability.
// Strategy: network-first for pages API, cache-first for static assets.

const CACHE_NAME = 'lucide-reader-v1';

self.addEventListener('install', () => {
    self.skipWaiting();
    // We intentionally keep the pre-cache minimal to avoid stale content issues
});

self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(keys =>
            Promise.all(keys.filter(k => k !== CACHE_NAME).map(k => caches.delete(k)))
        )
    );
    return self.clients.claim();
});

self.addEventListener('fetch', event => {
    const url = new URL(event.request.url);

    // Skip non-GET requests and browser extension URLs
    if (event.request.method !== 'GET' || !url.protocol.startsWith('http')) return;

    // Pages API: always network, no cache
    if (url.pathname.includes('/paginas')) {
        event.respondWith(fetch(event.request));
        return;
    }

    // For navigation requests (HTML pages): network-first, fall back to cache
    if (event.request.mode === 'navigate') {
        event.respondWith(
            fetch(event.request)
                .then(response => {
                    // Cache a copy of the response
                    const clone = response.clone();
                    caches.open(CACHE_NAME).then(cache => cache.put(event.request, clone));
                    return response;
                })
                .catch(() => caches.match(event.request))
        );
        return;
    }

    // Static assets (JS, CSS, fonts, images): cache-first
    if (url.pathname.startsWith('/build/') || url.pathname.startsWith('/fonts/') || url.pathname.startsWith('/images/')) {
        event.respondWith(
            caches.match(event.request).then(cached => {
                if (cached) return cached;
                return fetch(event.request).then(response => {
                    const clone = response.clone();
                    caches.open(CACHE_NAME).then(cache => cache.put(event.request, clone));
                    return response;
                });
            })
        );
        return;
    }
});


