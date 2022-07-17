<?php


namespace LibraryApi\Repositories;

use LibraryApi\Microkernel\Container\Container;
use LibraryApi\Microkernel\Microkernel;
use LibraryApi\Modules\Database\DatabaseDriverInterface;
use LibraryApi\Modules\Database\DatabaseModule;

class BaseRepository
{
    protected function getDatabase(): DatabaseDriverInterface
    {
        return Container::instance()->make(DatabaseDriverInterface::class);
    }

    protected function select(string $sqlQuery, array $params = []): array
    {
        return $this->getDatabase()->select($sqlQuery, $params);
    }
}
