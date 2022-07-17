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

    public function index(): string
    {
        $bookName = trim($this->getQueryParam('book_name') ?? '');
        if (empty($bookName)) {
            return $this->response($this->serialize($this->authorRepository->getAll()));
        }
        return $this->response(
            $this->serialize($this->authorRepository->getByBook($bookName)));
    }

    public function serialize(array $data): array
    {
        $formattedData = [];
        foreach ($data as $row) {
            if (!isset($formattedData[$row['id']])) {
                $formattedData[$row['id']]['id'] = $row['id'];
                $formattedData[$row['id']]['fullname'] = $row['fullname'];
                $formattedData[$row['id']]['birth_date'] = $row['id'];
                $formattedData[$row['id']]['description'] = $row['id'];
            }

            $book = [];
            $book['id'] = $row['book_id'];
            $book['name'] = $row['book_name'];
            $book['description'] = $row['book_description'];
            $book['year'] = $row['book_year'];
            $book['genre'] = $row['book_genre'];

            $formattedData[$row['id']]['books'][] = $book;
        }
        return ['data' => array_values($formattedData)];
    }
}
