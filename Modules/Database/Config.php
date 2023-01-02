<?php


namespace LibraryApi\Modules\Database;


class Config
{
    /**
     * @var array
     */
    private array $properties;

    public function __construct(array $properties)
    {
        $this->properties = $properties;
    }

    /**
     * @param string $propertyName
     * @return string
     */
    public function get(string $propertyName): string
    {
        return $this->properties[$propertyName] ?? '';
    }

}
