<?php


namespace LibraryApi\Repositories;

use LibraryApi\Repositories\Interfaces\AuthorRepositoryInterface;

class AuthorRepository extends DatabaseRepository implements AuthorRepositoryInterface
{
    public function getByBook(string $bookName): array
    {
        return $this->select(
                'SELECT 
                                author.*,
                                book.id AS book_id, 
                                book.name AS book_name, 
                                book.description AS book_description, 
                                book.year AS book_year, 
                                book.genre AS book_genre
                            FROM 
                                author 
                            INNER JOIN 
                                    author_book ON author_book.author_id = author.id
                            INNER JOIN 
                                    book ON book.id = author_book.book_id AND book.name LIKE ?',
                ['s' => '%' . $bookName . '%'] // 's' specifies the variable type => 'string'
            );
    }


    public function getAll(): array
    {
        return $this->select(
                'SELECT 
                                author.*,
                                book.id AS book_id, 
                                book.name AS book_name, 
                                book.description AS book_description, 
                                book.year AS book_year, 
                                book.genre AS book_genre
                            FROM 
                                author 
                            INNER JOIN 
                                    author_book ON author_book.author_id = author.id
                            INNER JOIN 
                                    book ON book.id = author_book.book_id'
            );
    }
}
