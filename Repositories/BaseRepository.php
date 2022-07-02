<?php


namespace LibraryApi\Repositories;

use LibraryApi\Database\DataBaseDriverInterface;
use LibraryApi\DI\DependencyInjectionContainer;

class BaseRepository
{
    /**
     * @var DataBaseDriverInterface $dataBase
     */
    protected $dataBase;

    public function __construct()
    {
        $this->dataBase = DependencyInjectionContainer::instance()->make(DataBaseDriverInterface::class);
    }

}
