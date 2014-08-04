## ZF2-AcQrCode

[![Build Status](https://travis-ci.org/acelaya/ZF2-AcQrCode.svg?branch=develop)](https://travis-ci.org/acelaya/ZF2-AcQrCode)
[![Latest Stable Version](https://poser.pugx.org/acelaya/zf2-acqrcode/v/stable.png)](https://packagist.org/packages/acelaya/zf2-acqrcode)
[![Total Downloads](https://poser.pugx.org/acelaya/zf2-acqrcode/downloads.png)](https://packagist.org/packages/acelaya/zf2-acqrcode)
[![License](https://poser.pugx.org/acelaya/zf2-acqrcode/license.png)](https://packagist.org/packages/acelaya/zf2-acqrcode)

This Zend Framework 2 module allows you to easily generate QR codes by using the [Endroid QR Code](https://github.com/endroid/QrCode) library, by [Endroid](https://github.com/endroid).

It has been based on the [EndroidQrCodeBundle](https://github.com/endroid/EndroidQrCodeBundle) Symfony bundle.

Installation
------------

The preferred installation method is by using [composer](https://getcomposer.com). Just add this package to your composer.json

```json
{
    "require": {
        "acelaya/zf2-acqrcode": "0.*"
    }
}
```
and update your dependencies with composer `php composer.phar update`

After that you just need to add the module to the list of enabled modules in you `application.config.php` file

```php
'modules' => array(
    'Application',
    'ZfcUser',
    'ZfcBase',
    'Acelaya\QrCode' // <-- This line will do the job
)
```

Usage
-----

The module can be used in many ways. It includes a route which points to a controller which returns the QR code image as a response.

You can simply use that route to create your own QR codes by passing three simple arguments. The message to be encoded, the extension of the image (jpg, png or gif) and the size of the image.

In your view template do something like this.

```php
<img src="<?php echo $this->url('acelaya-qrcode', ['message' => 'This is a QR code example']) ?>">
<img src="<?php echo $this->url('acelaya-qrcode', ['message' => 'Another QR code', 'extension' => 'gif']) ?>">
<img src="<?php echo $this->url('acelaya-qrcode', ['message' => 'Something bigger', 'extension' => 'png', 'size' => '600']) ?>">
```

By default the extension is jpg, and the size is 200. The message has to be provided.

#### The view helper

To ease that task, a view helper is provided. By using it you can directly render img tags pointing to that QR code or just get the assembled route just like you would do with the `url` view helper.

```php
<?php echo $this->qrCode()->renderImg('The message', 'png'); ?>
```

This will produce this image

```html
<img src="/qr-code/generate/The%20message.png">
```

If you need aditional attributes in the img tag, the fourth argument is an array with the attributes and their values.

```php
<?php echo $this->qrCode()->renderImg('The message', 'png', '300', ['title' => 'This is a cool QR code', 'class' => 'img-thumbnail']); ?>
```

This will produce this image

```html
<img src="/qr-code/generate/The%20message.png/300" title="This is a cool QR code" class="img-thumbnail">
```

If your application is XHTML, the image tag will automatically be closed with `/>`. If it is HTML5 it will be closed with just `>`

If you just need to get the route, this view helper is a shortcut to the `url` view helper if you use it like this.

```php
<div>
    <h2>This is a nice title</h2>
    <div style="background: url(<?php echo $this->qrCode('The message', 'png') ?>);"></div>
</div>
```

If you need aditional route options to be used, it can be done like this.

```php
<div>
    <h2>This is a nice title</h2>
    <div style="background: url(<?php echo $this->qrCode()->setRouteOptions(['force_canonical' => true])->assembleRoute('The message', 'png') ?>);"></div>
</div>
```

#### The service

If that view helper does not fit your needs, or you need to do something else with the QR codes, like saving them to some storage system, you can directly use the `QrCodeService`.

It has been registered with the key `Acelaya\QrCode\Service\QrCodeService` in order for you to inject it to any of your own services.

The returned object is a `Acelaya\QrCode\Service\QrCodeService` which implements `Acelaya\QrCode\Service\QrCodeServiceInterface`.

```php
/** @var \Zend\ServiceManager\ServiceLocatorInterface $sm */
$service = $sm->get('Acelaya\QrCode\Service\QrCodeService');
$content = $service->getQrCodeContent('http://www.alejandrocelaya.com/', 'png');

// Save the image to disk
file_put_contents('/path/to/file.png', $content);
```

Testing
-------

This module includes all its unit tests and follows dependency injection and abstraction for you to be able to test any component that depend on its classes.

