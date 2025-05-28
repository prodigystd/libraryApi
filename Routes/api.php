<?php

use LibraryApi\Middleware\TestCheckMiddleware;

return $routes = [
    'GET, /books' => ['BookController@index', TestCheckMiddleware::class],
    'GET, /books/books-by-author' => ['BookController@byAuthor', TestCheckMiddleware::class],
    'GET, /books/books-by-author-count' => ['BookController@byAuthorCount', TestCheckMiddleware::class],

    'GET, /authors' => ['AuthorController@index', TestCheckMiddleware::class],
    'GET, /authors/authors-by-book' => ['AuthorController@byBook', TestCheckMiddleware::class],
];
