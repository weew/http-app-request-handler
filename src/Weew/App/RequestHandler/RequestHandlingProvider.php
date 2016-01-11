<?php

namespace Weew\App\RequestHandler;

use Weew\Container\IContainer;
use Weew\Eventer\IEventer;
use Weew\App\Http\Events\HandleHttpRequestEvent;
use Weew\Router\ContainerAware\Router as ContainerAwareRouter;
use Weew\Router\Invoker\ContainerAware\IRoutesInvoker;
use Weew\Router\Invoker\ContainerAware\RoutesInvoker;
use Weew\Router\IRouter;
use Weew\Router\Router;

class RequestHandlingProvider {
    /**
     * @var IContainer
     */
    protected $container;

    /**
     * @var IEventer
     */
    protected $eventer;

    /**
     * @var IRouter
     */
    protected $router;

    /**
     * @var IRoutesInvoker
     */
    protected $routesInvoker;

    /**
     * @var IRequestHandler
     */
    protected $requestHandler;

    /**
     * @param IContainer $container
     * @param IEventer $eventer
     * @param ContainerAwareRouter $router
     * @param RoutesInvoker $routesInvoker
     */
    public function boot(
        IContainer $container,
        IEventer $eventer,
        ContainerAwareRouter $router,
        RoutesInvoker $routesInvoker
    ) {
        $this->container = $container;
        $this->eventer = $eventer;
        $this->router = $router;
        $this->routesInvoker = $routesInvoker;
        $this->requestHandler = new RequestHandler($router, $routesInvoker);

        $this->shareInstancesInContainer();
        $this->setUpEvents();
    }

    /**
     * Handle HandleHttpRequestEvent and create a response.
     *
     * @param HandleHttpRequestEvent $event
     */
    public function handleHttpRequestEvent(HandleHttpRequestEvent $event) {
        $event->setResponse(
            $this->requestHandler->handle($event->getRequest())
        );
    }

    /**
     * Share instances in the container.
     */
    protected function shareInstancesInContainer() {
        $this->container->set([Router::class, IRouter::class], $this->router);
        $this->container->set(
            [RequestHandler::class, IRequestHandler::class], $this->requestHandler
        );
    }

    /**
     * Set up lifecycle events for this provider.
     */
    protected function setUpEvents() {
        $this->eventer->subscribe(
            HandleHttpRequestEvent::class, [$this, 'handleHttpRequestEvent']
        );
    }
}
