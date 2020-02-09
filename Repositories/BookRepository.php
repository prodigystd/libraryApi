<?php


namespace LibraryApi\Repositories;


class BookRepository extends BaseRepository
{
    public function getBookByAuthor()
    {
        return $this->dataBase->select('select * from book');
    }


}
