var dataCache = 'swDataConn-1.01';
var shellCache = 'swShellConn-1.01';
var filesToCache = ["http://localhost/site-multiplica/uploads/image/2018/07/logo.jpg","http://localhost/site-multiplica/uploads/image/2018/07/favicon-multiplica.png","http://localhost/site-multiplica/assetsPublic/core.min.js?1.78","http://localhost/site-multiplica/assetsPublic/core.min.css?1.78","http://localhost/site-multiplica/assetsPublic/fonts.min.css?1.78","http://localhost/site-multiplica/vendor/conn/link-control/tplFront/button.mst","http://localhost/site-multiplica/vendor/conn/link-control/tplFront/button_icon.mst","http://localhost/site-multiplica/vendor/conn/link-control/tplFront/card.mst","http://localhost/site-multiplica/vendor/conn/link-control/tplFront/col.mst","http://localhost/site-multiplica/vendor/conn/link-control/tplFront/col_1.mst","http://localhost/site-multiplica/vendor/conn/link-control/tplFront/col_2.mst","http://localhost/site-multiplica/vendor/conn/link-control/tplFront/col_3.mst","http://localhost/site-multiplica/vendor/conn/link-control/tplFront/col_4.mst","http://localhost/site-multiplica/vendor/conn/link-control/tplFront/col_5.mst","http://localhost/site-multiplica/vendor/conn/link-control/tplFront/col_6.mst","http://localhost/site-multiplica/vendor/conn/link-control/tplFront/container.mst","http://localhost/site-multiplica/vendor/conn/link-control/tplFront/container_large.mst","http://localhost/site-multiplica/vendor/conn/link-control/tplFront/container_small.mst","http://localhost/site-multiplica/vendor/conn/link-control/tplFront/demo.png","http://localhost/site-multiplica/vendor/conn/link-control/tplFront/h1.mst","http://localhost/site-multiplica/vendor/conn/link-control/tplFront/h2.mst","http://localhost/site-multiplica/vendor/conn/link-control/tplFront/h3.mst","http://localhost/site-multiplica/vendor/conn/link-control/tplFront/h4.mst","http://localhost/site-multiplica/vendor/conn/link-control/tplFront/h5.mst","http://localhost/site-multiplica/vendor/conn/link-control/tplFront/h6.mst","http://localhost/site-multiplica/vendor/conn/link-control/tplFront/header.mst","http://localhost/site-multiplica/vendor/conn/link-control/tplFront/icon.mst","http://localhost/site-multiplica/vendor/conn/link-control/tplFront/img.mst","http://localhost/site-multiplica/vendor/conn/link-control/tplFront/input.mst","http://localhost/site-multiplica/vendor/conn/link-control/tplFront/input_icon.mst","http://localhost/site-multiplica/vendor/conn/link-control/tplFront/parallax.mst","http://localhost/site-multiplica/vendor/conn/link-control/tplFront/post_card.mst","http://localhost/site-multiplica/vendor/conn/link-control/tplFront/post_flat.mst","http://localhost/site-multiplica/vendor/conn/link-control/tplFront/script.mst","http://localhost/site-multiplica/vendor/conn/link-control/tplFront/section_full.mst","http://localhost/site-multiplica/vendor/conn/link-control/tplFront/section_large.mst","http://localhost/site-multiplica/vendor/conn/link-control/tplFront/section_medium.mst","http://localhost/site-multiplica/vendor/conn/link-control/tplFront/section_small.mst","http://localhost/site-multiplica/vendor/conn/link-control/tplFront/style.mst","http://localhost/site-multiplica/vendor/conn/link-control/tplFront/ul.mst","http://localhost/site-multiplica/vendor/conn/link-control/assets/dino.png","http://localhost/site-multiplica/assets/img/back.jpg","http://localhost/site-multiplica/assets/img/people.jpg","http://localhost/site-multiplica/assets/img/people2.jpg","http://localhost/site-multiplica/assets/index.min.css?1.78","http://localhost/site-multiplica/assets/index.min.js?1.78","http://localhost/site-multiplica/assets/multiplica.min.js?1.78"];
var filesToCacheAfter = ["http://localhost/site-multiplica/","http://localhost/site-multiplica/index","http://localhost/site-multiplica/404","http://localhost/site-multiplica/network","http://localhost/site-multiplica/blank","http://localhost/site-multiplica/data/index","http://localhost/site-multiplica/data/404","http://localhost/site-multiplica/data/network","http://localhost/site-multiplica/data/blank","http://localhost/site-multiplica/relatorioConvenios","http://localhost/site-multiplica/data/relatorioConvenios"];

self.addEventListener('install', function (e) {
    console.log('SW Install');
    e.waitUntil(
        caches.open(shellCache).then(function (cache) {
            console.log('SW SHELL Install');
            return cache.addAll(filesToCache);
        })
    );
    caches.open(dataCache).then(function (cache) {
        console.log('SW DATA Install');
        cache.addAll(filesToCacheAfter);
    });
});

self.addEventListener('activate', function (e) {
    console.log('SW Activate');
    e.waitUntil(
        caches.keys().then(function (keyList) {
            return Promise.all(keyList.map(function (key) {
                if (key !== shellCache && key !== dataCache) {
                    console.log('SW Removing old cache', key);
                    return caches.delete(key);
                }
            }));
        })
    );
    return self.clients.claim();
});

self.addEventListener('fetch', function (e) {
    console.log('SW Fetch', e.request.url);

    let patt = new RegExp(/\.(((css|js)\?v=)|mst|png|jpg|ico|gif|jpeg|svg|ttf)/);
    let viewPatt = new RegExp(/view\/.+/);
    let pagePatt = new RegExp(/(view|data)\/.+/);
    if (patt.test(e.request.url)) {
        //SHELL GET CACHE OR ONLINE
        e.respondWith(
            caches.match(e.request).then(function (response) {
                return response || fetch(e.request);
            })
        );
    } else {
        //DATA - CHECK FOR NEW CONTENT OR GET THE CACHE
        e.respondWith(
            caches.open(dataCache).then(function (cache) {
                return cache.match(e.request).then(function (response) {

                    //update cache
                    var fetchPromise = fetch(e.request).then(function (networkResponse) {
                        if (networkResponse && networkResponse.status === 200 && networkResponse.type === 'basic' && response)
                            cache.put(e.request, networkResponse.clone());

                        return networkResponse;

                    }).catch(function (error) {
                        if(error.toString() === "TypeError: Failed to fetch" && !response) {
                            if(pagePatt.test(e.request.url)) {
                                return cache.match("get/" + (viewPatt.test(e.request.url) ? "network" : "blank")).then(function (response) {
                                    return response;
                                });
                            } else {
                                return cache.match("network").then(function (response) {
                                    return response;
                                });
                            }
                        }
                    });

                    return response || fetchPromise;
                })
            })
        );
    }
});

window.addEventListener('beforeinstallprompt', (e) => {
    // Prevent Chrome 67 and earlier from automatically showing the prompt
    e.preventDefault();
    // Stash the event so it can be triggered later.
    deferredPrompt = e;
    // Update UI notify the user they can add to home screen
    btnAdd.style.display = 'block';
});