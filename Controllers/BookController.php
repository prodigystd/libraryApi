<?php

namespace LibraryApi\Controllers;

use LibraryApi\Resources\Books;
use LibraryApi\Services\Interfaces\BookServiceInterface;

class BookController extends ApiController
{
    /**
     * @var BookServiceInterface $bookService
     */
    private BookServiceInterface $bookService;

    public function __construct(BookServiceInterface $bookService)
    {
        $this->bookService = $bookService;
    }

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

        return $this->response(
            $this->serialize($this->bookService->getAll())
        );
    }




}
