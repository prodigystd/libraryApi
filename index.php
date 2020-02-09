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
    require $fileName;
}
spl_autoload_register('autoload');

$url = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$routes = [
    'GET, /books-by-author' => 'AuthorController@byAuthor',
    'GET, /author-by-book' => 'AuthorController@byBook',
    'GET, /books-by-author-count' => 'BookController@byAuthorCount',
];

$routeKeyToFind = $method . ', ' . rtrim($url, "/");

if (isset($routes[$routeKeyToFind])) {
    $action = explode('@', $routes[$routeKeyToFind]);
    call_user_func(["\LibraryApi\Controllers\\". $action[0], $action[1]]);
} else {
    echo 'Route is not found';
}



