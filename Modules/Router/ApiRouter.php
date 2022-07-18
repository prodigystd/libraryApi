<?php

namespace LibraryApi\Modules\Router;

use LibraryApi\Microkernel\Container\ContainerInterface;
use LibraryApi\Middleware\Middleware;

class ApiRouter implements RouterInterface
{
    /**
     * @var array
     */
    private $routes = [];
    /**
     * @var string
     */
    private $controllerNamespace;
    /**
     * @var ContainerInterface
     */
    private $container;


    public function setRoutes(array $routes)
    {
        $this->routes = $routes;
    }

    public function setControllerNamespace(string $controllerNamespace)
    {
        $this->controllerNamespace = $controllerNamespace;
    }

    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function handle()
    {
        $url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        $route = $method . ', ' . rtrim($url, "/");

        if (isset($this->routes[$route])) {
            $routeAction = $this->routes[$route];

            if (is_array($routeAction)) {
                list($controllerAction, $middlewareClass) = $routeAction;
                /** @var Middleware $middleware */
                $middleware = new $middlewareClass;
            } else {
                $controllerAction = $routeAction;
                $middleware = null;
            }

            list($controllerName, $action) = explode('@', $controllerAction);
            $controller = $this->container->make($this->controllerNamespace . '\\' . $controllerName);

            if ($middleware instanceof Middleware) {
                echo $middleware->handle([$controller, $action]);
            } else {
                echo call_user_func([$controller, $action]);
            }

        } else {
            $controller = new \LibraryApi\Controllers\ApiController();
            echo $controller->response(['error' => 'Route is not found'], 404);
        }
    }

}
