<?php

namespace LibraryApi\Controllers;

use LibraryApi\Repositories\BookRepository;

class BookController extends ApiController
{
    /**
     * @var BookRepository $bookRepository
     */
    private $bookRepository;

    public function __construct()
    {
        $this->bookRepository = new BookRepository();
    }

    public function ByAuthor()
    {
        $authorName = $this->getQueryParam('author_name');
        if (empty($authorName)) {
            return $this->response($this->serialize([]));
        }
        return $this->response(
            $this->serialize($this->bookRepository->getByAuthor($authorName)));
    }


    public function ByAuthorCount()
    {
        $authorCount = (int)$this->getQueryParam('author_count');
        if (empty($authorCount) && $authorCount < 1) {
            return $this->response($this->serialize([]));
        }
        return $this->response(
            $this->serialize($this->bookRepository->getByAuthorCount($authorCount)));
    }


    public function serialize(array $data)
    {
        return ['books' => $data];
    }

}
