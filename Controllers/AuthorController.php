<?php

namespace LibraryApi\Controllers;

use LibraryApi\Resources\Authors;
use LibraryApi\Services\Interfaces\AuthorServiceInterface;

class AuthorController extends ApiController
{
    /**
     * @var AuthorServiceInterface $authorService
     */
    private $authorService;

    public function __construct(AuthorServiceInterface $authorService)
    {
        $this->authorService = $authorService;
    }

    public function index(): string
    {
        $bookName = trim($this->getQueryParam('book_name') ?? '');

        if ($bookName) {
            $authorsResource = new Authors($this->authorService->getByBook($bookName));
            return $this->response(
                $authorsResource->serialize()
            );
        }

        $authorsResource = new Authors($this->authorService->getAll());
        return $this->response(
            $authorsResource->serialize()
        );
    }

}
