<?php


namespace LibraryApi\Services\Interfaces;


interface AuthorServiceInterface
{
    public function getByBook(string $bookName): array;

    public function getAll(): array;
}
