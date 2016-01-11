<?php

namespace Tests\Weew\App\Components\RequestHandler;

use PHPUnit_Framework_TestCase;
use Weew\App\Http\HttpApp;
use Weew\App\RequestHandler\RequestHandlingProvider;
use Weew\Http\HttpRequest;

class RequestHandlingProviderTest extends PHPUnit_Framework_TestCase {
    public function test_create() {
        $app = new HttpApp();
        $app->getKernel()->addProvider(RequestHandlingProvider::class);
        $app->handle(new HttpRequest());
    }
}
