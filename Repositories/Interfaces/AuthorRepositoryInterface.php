<?php


namespace LibraryApi\Repositories\Interfaces;


interface AuthorRepositoryInterface
{
    public function getByBook($bookName): array;
}
