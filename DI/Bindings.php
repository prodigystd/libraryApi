<?php

namespace LibraryApi\DI;

use LibraryApi\Repositories\AuthorRepository;
use LibraryApi\Repositories\BookRepository;
use LibraryApi\Repositories\Interfaces\AuthorRepositoryInterface;
use LibraryApi\Repositories\Interfaces\BookRepositoryInterface;

class Bindings
{
    public static $bindings = [
        AuthorRepositoryInterface::class => AuthorRepository::class,
        BookRepositoryInterface::class => BookRepository::class
    ];

}
