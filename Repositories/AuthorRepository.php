<?php


namespace LibraryApi\Repositories;

use LibraryApi\Repositories\Interfaces\AuthorRepositoryInterface;

class AuthorRepository extends BaseRepository implements AuthorRepositoryInterface
{
    public function getByBook($bookName): array
    {
        return $this->dataBase
            ->select(
                'SELECT 
                                book.name AS book_name, 
                                author.* 
                            FROM 
                                author 
                            INNER JOIN 
                                    author_book ON author_book.author_id = author.id
                            INNER JOIN 
                                    book ON book.id = author_book.book_id AND book.name LIKE ?',
                ['s' => '%' . $bookName . '%'] // 's' specifies the variable type => 'string'
            );
    }


}
