<?php


namespace LibraryApi\Repositories;


use LibraryApi\Repositories\Interfaces\BookRepositoryInterface;

class BookRepository extends BaseRepository implements BookRepositoryInterface
{
    public function getByAuthor($authorName): array
    {
        return $this->dataBase
            ->select(
                'select author.fullname as author_name, book.* from book 
                            inner join author_book on book.id = author_book.book_id
                            inner join author on author.id = author_book.author_id and author.fullname like ?'
                , ['s' => '%' . $authorName . '%']); // 's' specifies the variable type => 'string'
    }


    public function getByAuthorCount($authorCount): array
    {
        return $this->dataBase
            ->select('select book.id, book.name, book.description, book.year, book.genre, count(author_book.author_id) as author_count
                                from book
                                inner join author_book on book.id = author_book.book_id
                                group by book.id, book.name
                                having author_count = ?', ['i' => $authorCount]);
    }


}
