<?php


namespace LibraryApi\Repositories;


class AuthorRepository extends BaseRepository
{

    public function getByBook($bookName): array
    {
        return $this->dataBase
            ->select(
                'select book.name as book_name, author.* from author 
                            inner join author_book on author_book.author_id = author.id
                            inner join book on book.id = author_book.book_id and book.name like ?'
                , ['s' => '%' . $bookName . '%']); // 's' specifies the variable type => 'string'

    }


}
