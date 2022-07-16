<?php
namespace LibraryApi\Modules\Library;

use LibraryApi\Microkernel\Module\BaseModule;
use LibraryApi\Microkernel\Module\ModuleInterface;
use LibraryApi\Repositories\AuthorRepository;
use LibraryApi\Repositories\BookRepository;
use LibraryApi\Repositories\Interfaces\AuthorRepositoryInterface;
use LibraryApi\Repositories\Interfaces\BookRepositoryInterface;

class LibraryModule extends BaseModule implements ModuleInterface
{
    public function register()
    {
        $this->container->bind(AuthorRepositoryInterface::class, AuthorRepository::class);
        $this->container->bind(BookRepositoryInterface::class, BookRepository::class);
    }

    public function boot()
    {

    }
}