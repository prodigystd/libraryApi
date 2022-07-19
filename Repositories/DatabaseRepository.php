<?php


namespace LibraryApi\Repositories;

use LibraryApi\Microkernel\Container\Container;
use LibraryApi\Microkernel\Microkernel;
use LibraryApi\Modules\Database\DatabaseDriverInterface;
use LibraryApi\Modules\Database\DatabaseModule;

class DatabaseRepository
{
    /**
     * @var DatabaseDriverInterface $database
     */
    protected $database;

    public function __construct()
    {
        $this->database = Container::instance()->make(DatabaseDriverInterface::class);

    }

    protected function select(string $sqlQuery, array $params = []): array
    {
        return $this->database->select($sqlQuery, $params);
    }
}
