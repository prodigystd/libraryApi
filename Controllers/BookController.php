<?php

namespace LibraryApi\Controllers;

use LibraryApi\Resources\BooksByAuthor;
use LibraryApi\Services\Interfaces\BookServiceInterface;
use LibraryApi\Modules\Router\SystemController\ApiController;

class BookController extends ApiController
{
    public function __construct(private readonly BookServiceInterface $bookService)
    {
    }

    public function byAuthor(): string
    {
        $authorName = trim($this->getQueryParam('author_name') ?? '');

        if (empty($authorName)) {
            return $this->response($this->serialize([]));
        }

        $booksResource = new BooksByAuthor($this->bookService->getByAuthor($authorName));
        return $this->response(
            $booksResource->serialize()
        );
    }


    public function byAuthorCount(): string
    {
        $authorCount = (int)$this->getQueryParam('author_count');

        if (empty($authorCount) && $authorCount < 1) {
            return $this->response($this->serialize([]));
        }

        return $this->response(
            $this->serialize($this->bookService->getByAuthorCount($authorCount))
        );
    }

    public function index(): string
    {
        return $this->response(
            $this->serialize($this->bookService->getAll())
        );
    }


}
