<?php


$routes = [
    'GET, /books/by-author' => 'BookController@ByAuthor',
    'GET, /books/by-author-count' => 'BookController@byAuthorCount',
    'GET, /author/by-book' => 'AuthorController@byBook',
];
