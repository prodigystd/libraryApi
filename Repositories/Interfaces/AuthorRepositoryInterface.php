<?php


namespace LibraryApi\Repositories\Interfaces;


interface AuthorRepositoryInterface
{
    public function getByBook(string $bookName): array;

    public function getAll(): array;
}
