<?php

use LibraryApi\DI\DependencyInjectionContainer;
use LibraryApi\Router\RouterInterface;

function autoload($className)
{
    $className = ltrim($className, '\\');
    $fileName  = '';
    $namespace = '';
    $className = substr($className, strpos($className, '\\') + 1); //cutting VendorName
    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
    require_once $fileName;
}
spl_autoload_register('autoload');

/** @var RouterInterface $router */
$router = DependencyInjectionContainer::instance()->make(RouterInterface::class);
$router->handle();



