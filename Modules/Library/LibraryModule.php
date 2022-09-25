<?php
namespace LibraryApi\Modules\Library;

use LibraryApi\Microkernel\Module\BaseModule;
use LibraryApi\Microkernel\Module\ModuleInterface;
use LibraryApi\Repositories\AuthorRepository;
use LibraryApi\Repositories\BookRepository;
use LibraryApi\Repositories\Interfaces\AuthorRepositoryInterface;
use LibraryApi\Repositories\Interfaces\BookRepositoryInterface;
use LibraryApi\Services\AuthorService;
use LibraryApi\Services\BookService;
use LibraryApi\Services\Interfaces\AuthorServiceInterface;
use LibraryApi\Services\Interfaces\BookServiceInterface;

class LibraryModule extends BaseModule implements ModuleInterface
{
    public function register()
    {
        $this->container->bind(AuthorRepositoryInterface::class, AuthorRepository::class);
        $this->container->bind(BookRepositoryInterface::class, BookRepository::class);

        $this->container->bind(BookServiceInterface::class, BookService::class);
        $this->container->bind(AuthorServiceInterface::class, AuthorService::class);
    }

    public function boot()
    {

    }
}