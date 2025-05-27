<?php

namespace LibraryApi\Modules\Router;

use LibraryApi\Microkernel\Module\BaseModule;
use LibraryApi\Microkernel\Module\ModuleInterface;
use LibraryApi\Modules\Router\SystemController\ApiController;
use LibraryApi\Modules\Router\SystemController\ApiControllerInterface;
use LibraryApi\Modules\Router\SystemMiddleware\ControllerExecutionMiddleware;
use LibraryApi\Modules\Router\SystemMiddleware\ControllerExecutionMiddlewareInterface;

class RoutingModule extends BaseModule implements ModuleInterface
{

    private string $controllerNamespace = 'LibraryApi\Controllers';

    /**
     * @var array
     */
    private $routes;

    public function register()
    {
        $this->container->bind(RouterInterface::class, ApiRouter::class);
        $this->container->bind(ApiControllerInterface::class, ApiController::class);
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
        $router = $this->container->make(RouterInterface::class);
        $router->setContainer($this->container);
        $router->setControllerNamespace($this->controllerNamespace);
        $router->setRoutes($this->routes);
        $router->handle();
    }

    private function loadRoutes()
    {
        $this->routes = include dirname(__FILE__, 3) . "/Routes/api.php";
    }
}