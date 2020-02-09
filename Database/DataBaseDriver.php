<?php


namespace LibraryApi\Database;


interface DataBaseDriver
{
    public function select($sqlQuery, $params = []);
}
