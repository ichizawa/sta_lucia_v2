// const CACHE_NAME    = 'tms-v18';
// const STATIC_ASSETS = [

//   // — Admin pages —
//   '/admin/dashboard',
//   '/admin/space',
//   '/admin/space/add-space',
//   '/admin/space/view-space-modal',
//   '/admin/space/mall-option/{setup}',
//   '/admin/space/building-option/{setup}',
//   '/admin/space/level-option/{setup}',
//   '/admin/space/get-level',

//   '/admin/tenants',
//   '/admin/tenants/add-tenants',
//   '/admin/tenants/get-sub-category',
//   '/admin/tenants/view-tenants-modal',

//   '/admin/leases/mall-leaseable-info',
//   '/admin/leases/leases-proposal',
//   '/admin/leases/add-proposal',
//   '/admin/leases/pull-utilities-charges',
//   '/admin/leases/show-proposal',
//   '/admin/leases/show-counter-proposal',
//   '/admin/leases/get-business-info',
//   '/admin/leases/lease-option-proposal/{set}',

//   '/admin/utility',

//   '/admin/charges',

//   '/admin/category',
//   '/admin/category/categories',

//   '/admin/amenities',
//   '/admin/amenities/specific-amenities-delete',

//   '/admin/notices/award-notices/{option}',
//   '/admin/notices/get-files/{option}',
//   '/admin/notices/view-files/{option}',
//   '/admin/notices/vacate-notices',

//   '/admin/contract/renewal-contract',
//   '/admin/contract/view-contract',
//   '/admin/contract/termination-contract',

//   '/admin/billing-periods',

//   '/admin/settings',
//   '/admin/reports',
//   '/admin/payments',
//   '/admin/activity-log',

//   // — Client pages —
//   '/client/dashboard',
//   '/client/lease-proposals',
//   '/client/award-notice',
//   '/client/contracts',
//   '/client/space',
//   '/client/billing',
//   '/client/ledger',
//   '/client/setup/authorized-personnel',
//   '/client/setup/documents',

//   // — Biller pages —
//   '/biller/dashboard',
//   '/biller/collection/cashier',
//   '/biller/collection/ledger',
//   '/biller/billing/biller',
//   '/biller/billing/lists',
//   '/biller/billing/check-periods',
//   '/biller/billing-period',
//   '/biller/utility/reading',
//   '/biller/utility/lists',
//   '/biller/utility/utility-lists',
//   '/biller/utility/utility-reading',

//   // — Collector pages —
//   '/collector/dashboard',
//   '/collector/collect',
//   '/collector/collection/ledger',
//   '/collector/collection/contract-info',
//   '/collector/collection/check-periods',
//   '/collector/ledger/ledger-table',

//   // — Operation pages —
//   '/operation/dashboard',
//   '/operation/permits/pre-construction',
//   '/operation/permits/get-lists',
//   '/operation/permits/contract-lists',
//   '/operation/permits/work-permits',
//   '/operation/notices/award-notices/{option}',
//   '/operation/notices/get-files/{option}',
//   '/operation/notices/view-files/{option}',
//   '/operation/notices/vacate-notices',
//   '/operation/contract/renewal-contract',
//   '/operation/contract/view-contract',
//   '/operation/contract/termination-contract',
//   '/operation/construction/construction-release',
//   '/operation/utility-reading/reading',
//   '/operation/utility-reading/lists',
//   '/operation/utility-reading/utility-lists',
//   '/operation/utility-reading/utility-reading',

//   // — Lease-Admin pages —
//   '/lease-admin/dashboard',
//   '/lease-admin/commencement/lists',
//   '/lease-admin/permits/list',
//   '/lease-admin/permits/contract-lists',

//   // — Static assets —
//   '/assets/css/bootstrap.css',
//   '/assets/css/plugins.min.css',
//   '/assets/css/kaiadmin.min.css',
//   '/assets/shared/shared.css',
//   '/assets/css/sidebar-and-nav.css',
//   '/assets/img/stlm-logo.jpeg',
//   '/assets/js/tenant/multistep.js'
// // const CACHE_NAME = 'tms-v18';
// // const STATIC_ASSETS = [
// //   // your CSS / JS / images
// //   '/assets/css/bootstrap.css',
// //   '/assets/css/plugins.min.css',
// //   '/assets/css/kaiadmin.min.css',
// //   '/assets/shared/shared.css',
// //   '/assets/css/sidebar-and-nav.css',
// //   '/assets/img/stlm-logo.jpeg',
// //   '/assets/js/tenant/multistep.js'
// ];
// self.addEventListener('install', e => {
//   e.waitUntil(
//     caches.open(CACHE_NAME)
//       .then(cache => cache.addAll(STATIC_ASSETS))
//       .then(() => self.skipWaiting())
//   );
// });

// self.addEventListener('activate', e => {
//   e.waitUntil(
//     caches.keys().then(keys =>
//       Promise.all(
//         keys.map(key => key !== CACHE_NAME && caches.delete(key))
//       )
//     ).then(() => self.clients.claim())
//   );
// });

// // self.addEventListener('fetch', e => {
// //   const { request } = e;

// //   // only handle GET
// //   if (request.method !== 'GET') return;

// //   // navigation requests: HTML pages
// //   if (request.mode === 'navigate') {
// //     e.respondWith((async () => {
// //       try {
// //         const live = await fetch(request);
// //         // cache the fresh HTML
// //         if (live.ok && live.headers.get('content-type')?.includes('text/html')) {
// //           const cache = await caches.open(CACHE_NAME);
// //           cache.put(request, live.clone());
// //         }
// //         return live;
// //       } catch {
// //         // offline: serve cached page or fallback
// //         return (await caches.match(request))
// //           || caches.match('/offline.html');
// //       }
// //     })());
// //     return;
// //   }
// self.addEventListener('fetch', e => {
//   const { request } = e;
//   if (request.method === 'GET' && request.mode === 'navigate') {
//     e.respondWith((async () => {
//       const cache = await caches.open(CACHE_NAME);
//       const cached = await cache.match(request);

//       // Kick off a network fetch to update your cache, but don’t block on it:
//       const updating = fetch(request)
//         .then(live => {
//           if (live.ok &&
//               live.headers.get('content-type')?.includes('text/html')) {
//             cache.put(request, live.clone());
//           }
//           return live;
//         })
//         .catch(() => {}); // swallow errors

//       // Return the cached page if we have it, otherwise wait for the network:
//       return cached || updating || caches.match('/offline.html');
//     })());
//     return;
//   }
//   // all other GETs (CSS, JS, images, API data, etc.) → cache-first, then network
//   e.respondWith(
//     caches.match(request).then(cachedResponse => {
//       if (cachedResponse) return cachedResponse;
//       return fetch(request).then(networkResponse => {
//         // optional: you can cache new assets too
//         if (networkResponse.ok) {
//           caches.open(CACHE_NAME).then(cache => {
//             cache.put(request, networkResponse.clone());
//           });
//         }
//         return networkResponse;
//       }).catch(() => {
//         // if this was an image, you could return a placeholder here
//       });
//     })
//   );
// });
