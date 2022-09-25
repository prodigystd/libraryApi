<?php

namespace LibraryApi\Repositories;

use LibraryApi\Microkernel\Container\Container;
use LibraryApi\Modules\Database\DatabaseDriverInterface;

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
