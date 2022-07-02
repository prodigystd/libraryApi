<?php

namespace LibraryApi\Router;

use LibraryApi\DI\DependencyInjectionContainer;
use LibraryApi\Routes\ApiRoutes;

class ApiRouter implements RouterInterface
{
    public function handle()
    {
        $url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        $route = $method . ', ' . rtrim($url, "/");

        if (isset(ApiRoutes::$routes[$route])) {
            list($controllerName, $action) = explode('@', ApiRoutes::$routes[$route]);
            $container =  DependencyInjectionContainer::instance();
            $controller = $container->make('LibraryApi\Controllers\\' . $controllerName);
            echo call_user_func([$controller, $action]);
        } else {
            $controller = new \LibraryApi\Controllers\ApiController();
            echo $controller->response(['error' => 'Route is not found'], 404);
        }

    }

}
