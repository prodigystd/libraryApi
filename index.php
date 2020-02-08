<?php


spl_autoload_register(function ($className) {
    $className = str_replace("\\", DIRECTORY_SEPARATOR, $className);
    include_once $_SERVER['DOCUMENT_ROOT'] . '/' . $className . '.php';
});


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
    call_user_func(["\Controllers\\". $action[0], $action[1]]);
} else {
    echo 'Route is not found';
}



