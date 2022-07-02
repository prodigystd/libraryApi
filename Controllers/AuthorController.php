<?php

namespace LibraryApi\Controllers;

use LibraryApi\Repositories\Interfaces\AuthorRepositoryInterface;

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


    public function byBook(): string
    {
        $bookName = $this->getQueryParam('book_name');
        if (empty($bookName)) {
            return $this->response($this->serialize([]));
        }
        return $this->response(
            $this->serialize($this->authorRepository->getByBook($bookName)));
    }


    public function serialize(array $data): array
    {
        return ['authors' => $data];
    }

}
