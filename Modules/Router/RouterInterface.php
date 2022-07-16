<?php

namespace LibraryApi\Modules\Router;

use LibraryApi\Microkernel\Container\ContainerInterface;

interface RouterInterface
{
    public function setRoutes(array $routes);

    public function setControllerNamespace(string $controllerNamespace);

    public function setContainer(ContainerInterface $container);

    public function handle();
}
