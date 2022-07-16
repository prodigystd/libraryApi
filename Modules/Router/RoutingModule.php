<?php

namespace LibraryApi\Modules\Router;

use LibraryApi\Microkernel\Module\BaseModule;
use LibraryApi\Microkernel\Module\ModuleInterface;

class RoutingModule extends BaseModule implements ModuleInterface
{

    private $controllerNamespace = 'LibraryApi\Controllers';

    /**
     * @var array
     */
    private $routes;

    public function register()
    {
        $this->container->bind(RouterInterface::class, ApiRouter::class);
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