<?php

namespace LibraryApi\Services;

use LibraryApi\Repositories\Interfaces\BookRepositoryInterface;
use LibraryApi\Services\Interfaces\BookServiceInterface;

class BookService implements BookServiceInterface
{
    /**
     * @var BookServiceInterface
     */
    private $repository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->repository = $bookRepository;
    }

    public function getByAuthor(string $authorName): array
    {
        return $this->repository->getByAuthor($authorName);
    }

    public function getByAuthorCount(int $authorCount): array
    {
        return $this->repository->getByAuthorCount($authorCount);
    }

    public function getAll(): array
    {
        return $this->repository->getAll();
    }

}