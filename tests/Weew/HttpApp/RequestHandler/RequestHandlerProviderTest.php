<?php

namespace Tests\Weew\App\Components\RequestHandler;

use PHPUnit_Framework_TestCase;
use Weew\Config\Config;
use Weew\HttpApp\HttpApp;
use Weew\HttpApp\RequestHandler\IRequestHandler;
use Weew\HttpApp\RequestHandler\RequestHandlerProvider;
use Weew\Http\HttpRequest;
use Weew\Router\IRouter;

class RequestHandlerProviderTest extends PHPUnit_Framework_TestCase {
    public function test_create() {
        $app = new HttpApp();
        $config = new Config();
        $config->set('routing', [
            'routes' => [
                ['method' => 'GET', 'path' => '/foo', 'action' => 'foo']
            ]
        ]);
        $app->getConfigLoader()->addConfig($config);
        $app->getKernel()->addProvider(RequestHandlerProvider::class);
        $app->handleRequest(new HttpRequest());

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
