<?php

namespace LibraryApi\Modules\Router;

use LibraryApi\Microkernel\Module\BaseModule;
use LibraryApi\Microkernel\Module\ModuleInterface;
use LibraryApi\Modules\Router\SystemMiddleware\ApiRouteNotFoundMiddleware;
use LibraryApi\Modules\Router\SystemMiddleware\ApiRouteNotFoundMiddlewareInterface;
use LibraryApi\Modules\Router\SystemMiddleware\ControllerExecutionMiddleware;
use LibraryApi\Modules\Router\SystemMiddleware\ControllerExecutionMiddlewareInterface;

class RoutingModule extends BaseModule implements ModuleInterface
{
    private string $controllerNamespace = 'LibraryApi\Controllers';

    private array $routes;

    public function register()
    {
        $this->container->bind(RouterInterface::class, ApiRouter::class);
        $this->container->bind(
            ApiRouteNotFoundMiddlewareInterface::class,
            ApiRouteNotFoundMiddleware::class
        );
        $this->container->bind(
            ControllerExecutionMiddlewareInterface::class,
            ControllerExecutionMiddleware::class
        );
    }

    public function boot()
    {
        $this->loadRoutes();
        /**
         * @var RouterInterface $router
         */
        $router = $this->container->make(RouterInterface::class, [
            'controllerNamespace' => $this->controllerNamespace,
            'routes' => $this->routes
        ]);
        $router->setContainer($this->container);
        $router->handle();
    }

    private function loadRoutes()
    {
        $this->routes = include dirname(__FILE__, 3) . "/Routes/api.php";
    }
}