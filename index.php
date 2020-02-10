<?php

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
include 'routes.php';

$url = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$routeKeyToFind = $method . ', ' . rtrim($url, "/");
$routeKeyToFind = explode('?', $routeKeyToFind)[0];

if (isset($routes[$routeKeyToFind])) {
    $action = explode('@', $routes[$routeKeyToFind]);
    $controllerName = "\LibraryApi\Controllers\\". $action[0];
    $controllerObject = new $controllerName();
    echo call_user_func([$controllerObject, $action[1]]);
} else {
    $controllerObject = new \LibraryApi\Controllers\ApiController();
    echo $controllerObject->response(['error' => 'Route is not found'], 404);
}



