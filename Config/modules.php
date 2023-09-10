<?php


use LibraryApi\Modules\Database\DatabaseModule;
use LibraryApi\Modules\Library\LibraryModule;
use LibraryApi\Modules\Router\RoutingModule;

return [
    RoutingModule::class,
    DatabaseModule::class,
    LibraryModule::class
];