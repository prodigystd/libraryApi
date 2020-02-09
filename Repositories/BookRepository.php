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
                , ['s' => '%' . $authorName . '%']);
    }


}
