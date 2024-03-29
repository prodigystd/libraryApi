<?php


namespace LibraryApi\Repositories\Interfaces;


interface BookRepositoryInterface
{
    public function getByAuthor(string $authorName): array;

    public function getByAuthorCount(int $authorCount): array;

    public function getAll(): array;
}
