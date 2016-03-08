<?php

namespace Tests\Weew\App\Components\RequestHandler;

use PHPUnit_Framework_TestCase;
use Weew\Container\Container;
use Weew\HttpApp\RequestHandler\RequestHandler;
use Weew\Http\HttpRequest;
use Weew\Http\HttpStatusCode;
use Weew\Http\IHttpResponse;
use Weew\Router\ContainerAware\Router;
use Weew\Router\Invoker\ContainerAware\RoutesInvoker;

class RequestHandlerTest extends PHPUnit_Framework_TestCase {
    public function test_create() {
        $container = new Container();
        new RequestHandler(
            new Router($container), new RoutesInvoker($container)
        );
    }

    public function test_handle_request_resulting_in_404() {
        $container = new Container();
        $handler = new RequestHandler(
            new Router($container), new RoutesInvoker($container)
        );
        $response = $handler->handle(new HttpRequest());
        $this->assertTrue($response instanceof IHttpResponse);
        $this->assertTrue($response->getStatusCode() === HttpStatusCode::NOT_FOUND);
    }
}
