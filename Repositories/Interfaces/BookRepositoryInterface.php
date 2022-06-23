<?php


namespace LibraryApi\Repositories\Interfaces;


interface BookRepositoryInterface
{
    public function getByAuthor($authorName): array;

    public function getByAuthorCount($authorCount): array;

}
