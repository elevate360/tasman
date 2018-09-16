/**
 * Welcome to your Workbox-powered service worker!
 *
 * You'll need to register this file in your web app and you should
 * disable HTTP caching for this file too.
 * See https://goo.gl/nhQhGp
 *
 * The rest of the code is auto-generated. Please don't update this file
 * directly; instead, make changes to your Workbox build configuration
 * and re-run your build process.
 * See https://goo.gl/2aRDsh
 */

importScripts("https://storage.googleapis.com/workbox-cdn/releases/3.3.0/workbox-sw.js");

/**
 * The workboxSW.precacheAndRoute() method efficiently caches and responds to
 * requests for URLs in the manifest.
 * See https://goo.gl/S9QRab
 */
self.__precacheManifest = [
  {
    "url": "404.html",
    "revision": "028cca9152bd1ce73b22929fed301698"
  },
  {
    "url": "assets/css/3.styles.92c4f4d3.css",
    "revision": "7572230d8458d33e4965e8f81a52ef81"
  },
  {
    "url": "assets/img/search.83621669.svg",
    "revision": "83621669651b9a3d4bf64d1a670ad856"
  },
  {
    "url": "assets/js/0.ca9eb1f9.js",
    "revision": "3e592f1eb0a11b69673f914c90da593d"
  },
  {
    "url": "assets/js/1.7b757e66.js",
    "revision": "1386fd4ab6fe08e5309f9e877a24746a"
  },
  {
    "url": "assets/js/2.15fcb6eb.js",
    "revision": "3b3fd2ab9861e79656490ac2705ece98"
  },
  {
    "url": "assets/js/app.44ead2f8.js",
    "revision": "d665e40ce6ac4d3181384e210765e025"
  },
  {
    "url": "config/index.html",
    "revision": "2aacf4df9061cf4bb2dab9f9fd83ccce"
  },
  {
    "url": "index.html",
    "revision": "35eb06d65ef415011cd0aac447e690f0"
  },
  {
    "url": "logo.png",
    "revision": "e741d22f8ed60c25ffa80a79608a2fdf"
  },
  {
    "url": "screenshot.jpg",
    "revision": "1ecc70b950793b167ead1dccd04e6a6f"
  },
  {
    "url": "setup/index.html",
    "revision": "f9ad1ad5932f1cfd9edd8ff75b893882"
  }
].concat(self.__precacheManifest || []);
workbox.precaching.suppressWarnings();
workbox.precaching.precacheAndRoute(self.__precacheManifest, {});
