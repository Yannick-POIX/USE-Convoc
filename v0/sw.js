const CACHE_NAME = "v0"

/**
 * The install event is fired when the registration succeeds.
 * After the install step, the browser tries to activate the service worker.
 * Generally, we cache static resources that allow the website to run offline
 */
this.addEventListener('install', async function() {
    const cache = await caches.open(CACHE_NAME);
    cache.addAll([
        '/HTML/hello-list.html',
        '/CSS/main.css',
        '/JS/main.js',
    ])
})