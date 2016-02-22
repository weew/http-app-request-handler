<?php

namespace Tests\Weew\App\Components\RequestHandler;

use PHPUnit_Framework_TestCase;
use Weew\HttpApp\HttpApp;
use Weew\HttpApp\RequestHandler\IRequestHandler;
use Weew\HttpApp\RequestHandler\RequestHandlingProvider;
use Weew\Http\HttpRequest;
use Weew\Router\IRouter;

class RequestHandlingProviderTest extends PHPUnit_Framework_TestCase {
    public function test_create() {
        $app = new HttpApp();
        $config = $app->loadConfig();
        $config->set('routing', [
            'routes' => [
                ['method' => 'GET', 'path' => '/foo', 'action' => 'foo']
            ]
        ]);
        $app->getKernel()->addProvider(RequestHandlingProvider::class);
        $app->handle(new HttpRequest());

        /** @var IRouter $router */
        $router = $app->getContainer()->get(IRouter::class);
        $handler = $app->getContainer()->get(IRequestHandler::class);

        $routes = $router->getRoutes();
        $this->assertEquals(1, count($routes));
        $route = $routes[0];

        $this->assertEquals(['GET'], $route->getMethods());
        $this->assertEquals('/foo', $route->getPath());
        $this->assertEquals('foo', $route->getAction());
    }
}
