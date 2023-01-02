<?php

namespace LibraryApi\Services;

use LibraryApi\Repositories\Interfaces\AuthorRepositoryInterface;
use LibraryApi\Services\Interfaces\AuthorServiceInterface;

class AuthorService implements AuthorServiceInterface
{
    /**
     * @var AuthorRepositoryInterface
     */
    private AuthorRepositoryInterface $repository;

    public function __construct(AuthorRepositoryInterface $authorRepository)
    {
        $this->repository = $authorRepository;
    }

    public function getAll(): array
    {
        return $this->repository->getAll();
    }

    public function getByBook(string $bookName): array
    {
        return $this->repository->getByBook($bookName);
    }
}