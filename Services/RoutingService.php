<?php

namespace LibraryApi\Services;
use LibraryApi\DI\DependencyInjectionContainer;
use LibraryApi\Routes\ApiRoutes;

class RoutingService
{
    public function handle()
    {
        $url = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        $routeKeyToFind = $method . ', ' . rtrim($url, "/");
        $routeKeyToFind = explode('?', $routeKeyToFind)[0];

        if (isset(ApiRoutes::$routes[$routeKeyToFind])) {
            $action = explode('@', ApiRoutes::$routes[$routeKeyToFind]);
            $container =  DependencyInjectionContainer::instance();
            $controllerObject = $container->make($action[0]);
            echo call_user_func([$controllerObject, $action[1]]);
        } else {
            $controllerObject = new \LibraryApi\Controllers\ApiController();
            echo $controllerObject->response(['error' => 'Route is not found'], 404);
        }

    }

}
