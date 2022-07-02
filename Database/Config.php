<?php


namespace LibraryApi\Database;


class Config
{
    private static $properties = [
        'host' => 'libraryapi_db',
        'userName' => 'library',
        'password' => 'library',
        'dataBaseName' => 'library',
        'port' => '3306',
    ];

    /**
     * @param string $propertyName
     * @return string
     */
    public static function get(string $propertyName): string
    {
        return static::$properties[$propertyName] ?? '';
    }


}
