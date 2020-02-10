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
     * @param $propertyName
     * @return string
     */
    public static function get($propertyName)
    {
        return isset(static::$properties[$propertyName]) ? static::$properties[$propertyName] : null;
    }


}
