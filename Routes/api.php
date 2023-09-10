<?php

use LibraryApi\Middleware\TestCheckMiddleware;

return $routes = [
    'GET, /books' => ['BookController@index', TestCheckMiddleware::class],
    'GET, /authors' => ['AuthorController@index', TestCheckMiddleware::class],
];
