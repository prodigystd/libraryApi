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
//        var_dump($this->bookRepository->getBookByAuthor());
//        die;
        return $this->response($this->bookRepository->getBookByAuthor());
//        return 'Successfully called byAuthor()';
    }

}
