# Request handler

[![Build Status](https://img.shields.io/travis/weew/php-http-app-request-handler.svg)](https://travis-ci.org/weew/php-http-app-request-handler)
[![Code Quality](https://img.shields.io/scrutinizer/g/weew/php-http-app-request-handler.svg)](https://scrutinizer-ci.com/g/weew/php-http-app-request-handler)
[![Test Coverage](https://img.shields.io/coveralls/weew/php-http-app-request-handler.svg)](https://coveralls.io/github/weew/php-http-app-request-handler)
[![Version](https://img.shields.io/packagist/v/weew/php-http-app-request-handler.svg)](https://packagist.org/packages/weew/php-http-app-request-handler)
[![Licence](https://img.shields.io/packagist/l/weew/php-http-app-request-handler.svg)](https://packagist.org/packages/weew/php-http-app-request-handler)

## Table of contents

- [Installation](#installation)
- [Introduction](#introduction)
- [Usage](#usage)

## Installation

`composer require weew/php-http-app-request-handler`

## Introduction

This is a request handling component that is meant to be used together with the [weew/php-http-app](https://github.com/weew/php-http-app) package. It uses the [weew/php-router](https://github.com/weew/php-router) package for routing and the [weew/php-router-routes-invoker-container-aware](https://github.com/weew/php-router-routes-invoker-container-aware) package for routes invocation.

## Usage

Simply register this provider on the kernel.

```php
$app->getKernel()->addProviders([
    RequestHandlingProvider::class,
]);
```
