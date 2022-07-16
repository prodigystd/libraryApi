<?php


namespace LibraryApi\Modules\Database;

interface DataBaseDriverInterface
{
    public function setConfig(Config $config);

    public function select(string $sqlQuery, array $params = []): array;
}
