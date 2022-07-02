<?php

namespace LibraryApi\DI;

use LibraryApi\Database\DataBaseDriverInterface;
use LibraryApi\Database\MySqlDriver;
use LibraryApi\Repositories\AuthorRepository;
use LibraryApi\Repositories\BookRepository;
use LibraryApi\Repositories\Interfaces\AuthorRepositoryInterface;
use LibraryApi\Repositories\Interfaces\BookRepositoryInterface;
use LibraryApi\Router\ApiRouter;
use LibraryApi\Router\RouterInterface;

class Bindings
{
    public static $bindings = [
        AuthorRepositoryInterface::class => AuthorRepository::class,
        BookRepositoryInterface::class => BookRepository::class,
        RouterInterface::class => ApiRouter::class,
        DataBaseDriverInterface::class => MySqlDriver::class
    ];

}
