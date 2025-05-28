<?php

namespace LibraryApi\Modules\Router;

use LibraryApi\Microkernel\Container\ContainerInterface;
use LibraryApi\Modules\Router\SystemMiddleware\ApiRouteNotFoundMiddlewareInterface;

interface RouterInterface
{
    public function __construct(
        ApiRouteNotFoundMiddlewareInterface $routeNotFoundMiddleware,
        array $routes,
        string $controllerNamespace
    );

    public function setContainer(ContainerInterface $container);

    public function handle();
}
