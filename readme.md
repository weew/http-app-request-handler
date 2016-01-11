# Request handler

[![Build Status](https://img.shields.io/travis/weew/php-app-http-request-handler.svg)](https://travis-ci.org/weew/php-app-http-request-handler)
[![Code Quality](https://img.shields.io/scrutinizer/g/weew/php-app-http-request-handler.svg)](https://scrutinizer-ci.com/g/weew/php-app-http-request-handler)
[![Test Coverage](https://img.shields.io/coveralls/weew/php-app-http-request-handler.svg)](https://coveralls.io/github/weew/php-app-http-request-handler)
[![Version](https://img.shields.io/packagist/v/weew/php-app-http-request-handler.svg)](https://packagist.org/packages/weew/php-app-http-request-handler)
[![Licence](https://img.shields.io/packagist/l/weew/php-app-http-request-handler.svg)](https://packagist.org/packages/weew/php-app-http-request-handler)

## Table of contents

- [Installation](#installation)
- [Introduction](#introduction)
- [Usage](#usage)

## Installation

`composer require weew/php-app-http-request-handler`

## Introduction

This is a request handling component that is meant to be used together with the [weew/php-app-http](https://github.com/weew/php-app-http) package.

## Usage

To enable this provider simply register it on the kernel.

```php
$app->getKernel()->addProviders([
    RequestHandlingProvider::class,
]);
```
