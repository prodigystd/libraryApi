<?php


namespace LibraryApi\Repositories;

use LibraryApi\Repositories\Interfaces\BookRepositoryInterface;

class BookRepository extends BaseRepository implements BookRepositoryInterface
{
    public function getByAuthor($authorName): array
    {
        return $this->dataBase
            ->select(
                'SELECT 
                                author.fullname AS author_name, 
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
        return $this->dataBase
            ->select(
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


}
