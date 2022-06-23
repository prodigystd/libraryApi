<?php
namespace LibraryApi\Routes;

class ApiRoutes {
    /**
     * @array
     */
    public static $routes = [
        'GET, /book/books-by-author' => 'BookController@byAuthor',
        'GET, /book/books-by-author-count' => 'BookController@byAuthorCount',
        'GET, /author/authors-by-book' => 'AuthorController@byBook',
    ];

}