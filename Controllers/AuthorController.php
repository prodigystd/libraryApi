<?php

namespace LibraryApi\Controllers;

use LibraryApi\Repositories\AuthorRepository;

class AuthorController extends ApiController
{

    /**
     * @var AuthorRepository $authorRepository
     */
    private $authorRepository;

    public function __construct()
    {
        $this->authorRepository = new AuthorRepository();
    }


    public function byBook()
    {
        $bookName = $this->getQueryParam('book_name');
        if (empty($bookName)) {
            return $this->response($this->serialize([]));
        }
        return $this->response(
            $this->serialize($this->authorRepository->getByBook($bookName)));
    }


    public function serialize($data)
    {
        return ['authors' => $data];
    }




}
