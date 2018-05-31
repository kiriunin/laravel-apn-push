Laravel Apple Apn Push
==============

Send push notifications to apple devices (iPhone, iPad, iPod).

Support authenticators:

* Certificate
* Json Web Token

Supported protocols:

* HTTP/2

Requirements
------------

Now library work only with HTTP/2 protocol, and next libraries is necessary:

* [cURL](http://php.net/manual/ru/book.curl.php)
* The protocol [HTTP/2](https://en.wikipedia.org/wiki/HTTP/2) must be supported in cURL.
* PHP 7.1 or higher

Installation
------------

Add AppleApnPush in your Laravel project:

```bash
$ composer require kiriunin/laravel-apn-push
```