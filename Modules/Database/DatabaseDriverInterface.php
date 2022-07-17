<?php


namespace LibraryApi\Modules\Database;

interface DatabaseDriverInterface
{
    public function setConfig(Config $config);

    public function getConfig(): Config;

    public function select(string $sqlQuery, array $params = []): array;

    public function execute(string $sqlQuery, array $params = []): bool;
}
