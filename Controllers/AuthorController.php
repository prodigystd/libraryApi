<?php

namespace LibraryApi\Controllers;

use LibraryApi\Resources\AuthorsByBook;
use LibraryApi\Services\Interfaces\AuthorServiceInterface;
use LibraryApi\Modules\Router\SystemController\ApiController;

class AuthorController extends ApiController
{
    public function __construct(private readonly AuthorServiceInterface $authorService)
    {}

    public function index(): string
    {
        return $this->response(
            $this->serialize($this->authorService->getAll())
        );
    }

    public function byBook(): string
    {
        $bookName = trim($this->getQueryParam('book_name') ?? '');

        if (empty($bookName)) {
            return $this->response($this->serialize([]));
        }

        $authorsResource = new AuthorsByBook($this->authorService->getByBook($bookName));
        return $this->response(
            $authorsResource->serialize()
        );
    }

}
