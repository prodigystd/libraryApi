<?php

namespace LibraryApi\Controllers;

use LibraryApi\Resources\Books;
use LibraryApi\Services\Interfaces\BookServiceInterface;

class BookController extends ApiController
{
    public function __construct(private readonly BookServiceInterface $bookService)
    {}

    public function index(): string
    {
        $authorName = trim($this->getQueryParam('author_name') ?? '');
        $authorCount = (int)$this->getQueryParam('author_count');


        if ($authorName) {
            $booksResource = new Books($this->bookService->getByAuthor($authorName));
            return $this->response(
                $booksResource->serialize()
            );
        }

        if ($authorCount) {
            return $this->response(
                $this->serialize($this->bookService->getByAuthorCount($authorCount))
            );
        }

        $booksResource = new Books($this->bookService->getAll());
        return $this->response(
            $booksResource->serialize()
        );
    }




}
