<?php

namespace LibraryApi\Controllers;

use LibraryApi\Repositories\Interfaces\AuthorRepositoryInterface;
use LibraryApi\Resources\Authors;

class AuthorController extends ApiController
{
    /**
     * @var AuthorRepositoryInterface $authorRepository
     */
    private $authorRepository;

    public function __construct(AuthorRepositoryInterface $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function index(): string
    {
        $bookName = trim($this->getQueryParam('book_name') ?? '');

        if ($bookName) {
            $authorsResource = new Authors($this->authorRepository->getByBook($bookName));
            return $this->response(
                $authorsResource->serialize()
            );
        }

        $authorsResource = new Authors($this->authorRepository->getAll());
        return $this->response(
            $authorsResource->serialize()
        );
    }

}
