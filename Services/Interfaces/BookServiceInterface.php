<?php


namespace LibraryApi\Services\Interfaces;


interface BookServiceInterface
{
    public function getByAuthor(string $authorName): array;

    public function getByAuthorCount(int $authorCount): array;

    public function getAll(): array;
}
