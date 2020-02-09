<?php

namespace LibraryApi\Controllers;

use LibraryApi\Repositories\BookRepository;

class BookController extends ApiController
{
    /**
     * @var BookRepository
     */
    private $bookRepository;

    public function __construct()
    {
        $this->bookRepository = new BookRepository();
    }

    public function ByAuthor()
    {
        $authorName = $this->getQueryParam('name');
        if (empty($authorName)) {
            return $this->response($this->serialize([]));
        }
        return $this->response(
            $this->serialize($this->bookRepository->getBooksByAuthor($authorName)));
    }


    public function serialize($data)
    {
        return ['books' => $data];
    }

}
