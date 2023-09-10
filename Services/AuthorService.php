<?php

namespace LibraryApi\Services;

use LibraryApi\Repositories\Interfaces\AuthorRepositoryInterface;
use LibraryApi\Services\Interfaces\AuthorServiceInterface;

class AuthorService implements AuthorServiceInterface
{
    public function __construct(private readonly AuthorRepositoryInterface $repository)
    {
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