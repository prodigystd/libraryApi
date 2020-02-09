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
        return $this->response($this->bookRepository->getBookByAuthor());
    }

}
