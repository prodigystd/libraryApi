<?php


namespace LibraryApi\Repositories;

use LibraryApi\Microkernel\Container\Container;
use LibraryApi\Modules\Database\DataBaseDriverInterface;

class BaseRepository
{
    /**
     * @var DataBaseDriverInterface $dataBase
     */
    protected $dataBase;

    public function __construct()
    {
        $this->dataBase = Container::instance()->make(DataBaseDriverInterface::class);
    }

}
