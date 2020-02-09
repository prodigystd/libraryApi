<?php

namespace LibraryApi\Controllers;

use LibraryApi\Repositories\AuthorRepository;

class AuthorController extends ApiController
{

    /**
     * @var AuthorRepository
     */
    private $authorRepository;

    public function __construct()
    {
        $this->authorRepository = new AuthorRepository();
    }




}
