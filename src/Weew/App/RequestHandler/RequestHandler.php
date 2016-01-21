<?php

namespace Weew\App\RequestHandler;

use Weew\App\Http\Exceptions\HttpResponseException;
use Weew\Http\IHttpRequest;
use Weew\Http\IHttpResponse;
use Weew\Router\Invoker\ContainerAware\IRoutesInvoker;
use Weew\Router\IRouter;

class RequestHandler implements IRequestHandler {
    /**
     * @var IRouter
     */
    protected $router;

    /**
     * @var IRoutesInvoker
     */
    protected $routesInvoker;

    /**
     * RequestHandler constructor.
     *
     * @param IRouter $router
     * @param IRoutesInvoker $routesInvoker
     */
    public function __construct(
        IRouter $router,
        IRoutesInvoker $routesInvoker
    ) {
        $this->router = $router;
        $this->routesInvoker = $routesInvoker;
    }

    /**
     * @param IHttpRequest $request
     *
     * @return IHttpResponse
     */
    public function handle(IHttpRequest $request) {
        try {
            $route = $this->router->match(
                $request->getMethod(), $request->getUrl()
            );

            return $this->routesInvoker->invoke($route);
        } catch (HttpResponseException $ex) {
            return $ex->getHttpResponse();
        }
    }
}
