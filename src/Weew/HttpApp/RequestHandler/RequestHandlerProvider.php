<?php

namespace Weew\HttpApp\RequestHandler;

use Weew\Config\IConfig;
use Weew\Container\IContainer;
use Weew\Eventer\IEventer;
use Weew\HttpApp\Events\HandleHttpRequestEvent;
use Weew\Router\ContainerAware\Router as ContainerAwareRouter;
use Weew\Router\Invoker\ContainerAware\IRoutesInvoker;
use Weew\Router\Invoker\ContainerAware\RoutesInvoker;
use Weew\Router\IRouter;
use Weew\Router\Router;
use Weew\RouterConfigurator\IRouterConfigurator;
use Weew\RouterConfigurator\RouterConfigurator;

class RequestHandlerProvider {
    /**
     * @var IContainer
     */
    protected $container;

    /**
     * @var IEventer
     */
    protected $eventer;

    /**
     * @var IConfig
     */
    protected $config;

    /**
     * @var IRouter
     */
    protected $router;

    /**
     * @var IRouterConfigurator
     */
    protected $routerConfigurator;

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
     * @param IConfig $config
     * @param ContainerAwareRouter $router
     * @param RouterConfigurator $routerConfigurator
     * @param RoutesInvoker $routesInvoker
     */
    public function boot(
        IContainer $container,
        IEventer $eventer,
        IConfig $config,
        ContainerAwareRouter $router,
        RouterConfigurator $routerConfigurator,
        RoutesInvoker $routesInvoker
    ) {
        $this->container = $container;
        $this->config = $config;
        $this->eventer = $eventer;
        $this->router = $router;
        $this->routerConfigurator = $routerConfigurator;
        $this->routesInvoker = $routesInvoker;
        $this->requestHandler = new RequestHandler($router, $routesInvoker);

        $this->shareInstancesInContainer();
        $this->loadRoutesFromConfig();
        $this->setUpEvents();
    }

    /**
     * Handle HandleHttpRequestEvent and create a response.
     *
     * @param HandleHttpRequestEvent $event
     */
    public function handleHandleHttpRequestEvent(HandleHttpRequestEvent $event) {
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
     * Load routes from config.
     */
    protected function loadRoutesFromConfig() {
        $config = $this->config->getRaw('routing', []);
        $this->routerConfigurator->processConfig($this->router, $config);
    }

    /**
     * Set up lifecycle events for this provider.
     */
    protected function setUpEvents() {
        $this->eventer->subscribe(
            HandleHttpRequestEvent::class, [$this, 'handleHandleHttpRequestEvent']
        );
    }
}
