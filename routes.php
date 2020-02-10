<?php


$routes = [
    'GET, /book/books-by-author' => 'BookController@ByAuthor',
    'GET, /book/books-by-author-count' => 'BookController@byAuthorCount',
    'GET, /author/authors-by-book' => 'AuthorController@byBook',
];
