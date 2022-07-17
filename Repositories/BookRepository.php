<?php


namespace LibraryApi\Repositories;

use LibraryApi\Repositories\Interfaces\BookRepositoryInterface;

class BookRepository extends BaseRepository implements BookRepositoryInterface
{
    public function getByAuthor($authorName): array
    {
        return $this->select(
                'SELECT 
                                author.id AS author_id, 
                                author.fullname AS author_fullname, 
                                author.birth_date AS author_birth_date, 
                                author.description AS author_description, 
                                book.* 
                            FROM 
                                book 
                            INNER JOIN
                                    author_book ON book.id = author_book.book_id
                            INNER JOIN 
                                    author ON author.id = author_book.author_id AND author.fullname LIKE ?'
                , ['s' => '%' . $authorName . '%'] // 's' specifies the variable type => 'string'
            );
    }


    public function getByAuthorCount($authorCount): array
    {
        return $this->select(
                    'SELECT 
                                    book.id, 
                                    book.name, 
                                    book.description, 
                                    book.year, 
                                    book.genre, 
                                    COUNT(author_book.author_id) AS author_count
                                FROM 
                                    book
                                INNER JOIN 
                                        author_book ON book.id = author_book.book_id
                                GROUP BY 
                                    book.id, book.name
                                HAVING 
                                    author_count = ?',
                ['i' => $authorCount] // 's' specifies the variable type => 'integer'
            );
    }


    public function getAll(): array
    {
        return $this->select(
                'SELECT 
                                    *
                                FROM 
                                    book'
            );
    }
}
