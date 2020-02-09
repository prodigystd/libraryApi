<?php


namespace LibraryApi\Repositories;


use LibraryApi\Database\DataBaseDriver;
use LibraryApi\Database\MySqlDriver;

class BaseRepository
{
    /**
     * @var DataBaseDriver $dataBase
     */
    protected $dataBase;

    public function __construct()
    {
        $this->dataBase = $this->getDataBaseDriver();
    }


    protected function getDataBaseDriver(): DataBaseDriver
    {
        return new MySqlDriver();
    }

}
