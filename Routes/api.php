<?php

return $routes = [
    'GET, /books' => ['BookController@index', \LibraryApi\Middleware\TestCheckMiddleware::class],
    'GET, /authors' => ['AuthorController@index', \LibraryApi\Middleware\TestCheckMiddleware::class],
];
