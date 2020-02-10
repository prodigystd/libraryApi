<?php


namespace LibraryApi\Repositories;


class BookRepository extends BaseRepository
{
    public function getBooksByAuthor($authorName)
    {
        return $this->dataBase
            ->select(
                'select book.* from book 
                            inner join author_book on book.id = author_book.book_id
                            inner join author on author.id = author_book.author_id and author.fullname like ?'
                , ['s' => '%' . $authorName . '%']); // 's' specifies the variable type => 'string'
    }


    public function getBooksByAuthorCount($authorCount)
    {
        return $this->dataBase
            ->select('select book.id, book.name, book.description, book.year, book.genre, count(author_book.author_id) as author_count
                                from book
                                inner join author_book on book.id = author_book.book_id
                                group by book.id, book.name
                                having author_count = ?', ['i' => $authorCount]);
    }


}
