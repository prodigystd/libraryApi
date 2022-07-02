<?php


namespace LibraryApi\Database;


interface DataBaseDriverInterface
{
    public function select(string $sqlQuery, array $params = []): array;
}
