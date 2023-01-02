<?php

namespace LibraryApi\Modules\Router;

use LibraryApi\Microkernel\Container\ContainerInterface;
use LibraryApi\Middleware\Middleware;

class ApiRouter implements RouterInterface
{
    /**
     * @var array
     */
    private array $routes = [];
    /**
     * @var string
     */
    private string $controllerNamespace;
    /**
     * @var ContainerInterface
     */
    private ContainerInterface $container;


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

        if (!isset($this->routes[$route])) {
            $controller = new \LibraryApi\Controllers\ApiController();
            echo $controller->response(['error' => 'Route is not found'], 404);
            return;
        }

        $routeAction = $this->routes[$route];

        if (is_array($routeAction)) {
            if (isset($routeAction[1])) {
                [$controllerAction, $middlewareClass] = $routeAction;
                /** @var Middleware $middleware */
                $middleware = new $middlewareClass;

            } else {
                $controllerAction = $routeAction[0];
                $middleware = null;
            }
        } else {
            $controllerAction = $routeAction;
            $middleware = null;
        }

        [$controllerName, $action] = explode('@', $controllerAction);
        $controller = $this->container->make($this->controllerNamespace . '\\' . $controllerName);

        if ($middleware instanceof Middleware) {
            $callControllerAction = function (...$params) use ($controller, $action) {
                return $this->container->call([$controller, $action], $params);
            };

            echo $this->container->call([$middleware, 'handle'], ['action' => $callControllerAction]);
        } else {
            echo $this->container->call([$controller, $action]);
        }

    }

}
