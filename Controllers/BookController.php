<?php

namespace LibraryApi\Controllers;

use LibraryApi\Repositories\Interfaces\BookRepositoryInterface;

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

    public function byAuthor()
    {
        $authorName = $this->getQueryParam('author_name');
        if (empty($authorName)) {
            return $this->response($this->serialize([]));
        }
        return $this->response(
            $this->serialize($this->bookRepository->getByAuthor($authorName)));
    }


    public function byAuthorCount()
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
