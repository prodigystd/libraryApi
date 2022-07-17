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

    public function index(): string
    {
        $authorName = trim($this->getQueryParam('author_name') ?? '');
        $authorCount = (int)$this->getQueryParam('author_count');

        if ($authorName) {
            return $this->response(
                $this->serialize($this->bookRepository->getByAuthor($authorName))
            );
        }

        if ($authorCount) {
            return $this->response(
                parent::serialize($this->bookRepository->getByAuthorCount($authorCount))
            );
        }

        return $this->response(
            parent::serialize($this->bookRepository->getAll())
        );
    }

    public function serialize(array $data): array
    {
        $formattedData = [];
        foreach ($data as $row) {
            if (!isset($formattedData[$row['id']])) {
                $formattedData[$row['id']]['id'] = $row['id'];
                $formattedData[$row['id']]['name'] = $row['name'];
                $formattedData[$row['id']]['description'] = $row['description'];
                $formattedData[$row['id']]['year'] = $row['year'];
                $formattedData[$row['id']]['genre'] = $row['genre'];
            }

            $author = [];
            $author['id'] = $row['author_id'];
            $author['fullname'] = $row['author_fullname'];
            $author['birth_date'] = $row['author_birth_date'];
            $author['description'] = $row['author_description'];

            $formattedData[$row['id']]['author'] = $author;
        }
        return ['data' => array_values($formattedData)];
    }


}
