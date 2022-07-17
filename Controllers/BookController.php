<?php

namespace LibraryApi\Controllers;

use LibraryApi\Repositories\Interfaces\BookRepositoryInterface;
use LibraryApi\Resources\Books;

class BookController extends ApiController
{
    /**
     * @var BookRepositoryInterface $bookRepository
     */
    private $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function index(): string
    {
        $authorName = trim($this->getQueryParam('author_name') ?? '');
        $authorCount = (int)$this->getQueryParam('author_count');


        if ($authorName) {
            $booksResource = new Books($this->bookRepository->getByAuthor($authorName));
            return $this->response(
                $booksResource->serialize()
            );
        }

        if ($authorCount) {
            return $this->response(
                $this->serialize($this->bookRepository->getByAuthorCount($authorCount))
            );
        }

        return $this->response(
            $this->serialize($this->bookRepository->getAll())
        );
    }




}
