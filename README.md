Laravel Apple Apn Push
==============

[![Latest Version on Packagist](https://poser.pugx.org/kiriunin/laravel-apn-push/v/stable?format=flat-square)](https://packagist.org/packages/kiriunin/laravel-apn-push)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

Based on [https://github.com/ZhukV/AppleApnPush](https://github.com/ZhukV/AppleApnPush)

Send push notifications to Apple devices (iPhone, iPad, iPod).

Support authenticators:

* Json Web Token

Supported protocols:

* HTTP/2

Requirements
------------

* [cURL](http://php.net/manual/ru/book.curl.php)
* The protocol [HTTP/2](https://en.wikipedia.org/wiki/HTTP/2) must be supported in cURL.
* PHP 7.2 or higher

Installation
------------

Add library in your Laravel project:

```bash
$ composer require kiriunin/laravel-apn-push
```

Then publish configuration file:

```bash
$ php artisan vendor:publish --provider="Kiriunin\LaravelApnPush\ApnServiceProvider"
```


Development
-----------

For easy development and testing you can use own `Dockerfile` and build the image and next run container.

```bash
$ docker build -t laravel-apn-push .
$ docker run -it -d --name laravel-apn-push -v "${PWD}:/code" laravel-apn-push
$ docker exec -it laravel-apn-push bash

```
