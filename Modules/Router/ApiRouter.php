<?php

namespace LibraryApi\Modules\Router;

use LibraryApi\Microkernel\Container\ContainerInterface;
use LibraryApi\Modules\Router\SystemMiddleware\ApiRouteNotFoundMiddlewareInterface;
use LibraryApi\Modules\Router\SystemMiddleware\BaseMiddleware;
use LibraryApi\Modules\Router\SystemMiddleware\ControllerExecutionMiddlewareInterface;

class ApiRouter implements RouterInterface
{
    private ContainerInterface $container;

    public function __construct(
        private readonly ApiRouteNotFoundMiddlewareInterface $routeNotFoundMiddleware,
        private readonly array $routes,
        private readonly string $controllerNamespace
    )
    {
    }

    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function handle()
    {
        $requestRoute = $this->createRequestRoute();

        if (!isset($this->routes[$requestRoute])) {
            echo $this->routeNotFoundMiddleware->handle();
            return;
        }

        $routeConfig = $this->routes[$requestRoute];
        $controllerConfigAction = $routeConfig[0];

        $callableControllerMethod = $this->resolveControllerCallableMethod($controllerConfigAction);

        echo $this->container->call([$this->resolveMiddleware($callableControllerMethod, $routeConfig), 'handle']);
    }

    private function createRequestRoute(): string
    {
        $url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        return $requestMethod . ', ' . rtrim($url, "/");
    }

    private function resolveMiddleware(callable $callControllerAction, array $routeConfig) : BaseMiddleware
    {
        $controllerExecutionMiddleware = $this->container->make(
            ControllerExecutionMiddlewareInterface::class,
            ['action' => $callControllerAction, 'params' => [] ]
        );

        if (!isset($routeConfig[1])) {
            return $controllerExecutionMiddleware;
        }

        $middlewareClassesArray = array_slice($routeConfig, 1);
        $middlewareInstancesArray = $this->makeMiddlewareInstances($middlewareClassesArray);
        $middlewareInstancesArray[] = $controllerExecutionMiddleware;

        return $this->createMiddlewareChain($middlewareInstancesArray);
    }

    private function resolveControllerCallableMethod($controllerAction): callable
    {
        [$controllerName, $action] = explode('@', $controllerAction);
        $controller = $this->container->make($this->controllerNamespace . '\\' . $controllerName);
        return [$controller, $action];
    }

    private function makeMiddlewareInstances(array $middlewareClassesArray): array
    {
        $instances = [];
        foreach ($middlewareClassesArray as $clientMiddlewareClass) {
            $instances[] = $this->container->make($clientMiddlewareClass);
        }

        return $instances;
    }


    private function createMiddlewareChain(array $middlewareInstancesArray): BaseMiddleware
    {
        $reverseIterator = $middlewareInstancesArray;
        $currentMiddlewareInstance = end($reverseIterator);

        while (true) {
            $previousMiddlewareInstance = prev($reverseIterator);
            if ($previousMiddlewareInstance === false) {
                break;
            }

            $previousMiddlewareInstance->setNext($currentMiddlewareInstance);
            $currentMiddlewareInstance = $previousMiddlewareInstance;
        }

        return $currentMiddlewareInstance;
    }

}
