<?php


$routes = [
    'GET, /books-by-author' => 'AuthorController@byAuthor',
    'GET, /author-by-book' => 'AuthorController@byBook',
    'GET, /books-by-author-count' => 'BookController@byAuthorCount',
];
