<?php


namespace LibraryApi\Database;


interface DataBaseDriver
{
    public function select(string $sqlQuery, array $params = []): array;
}
