<?php
namespace LibraryApi\Middleware;

use LibraryApi\Controllers\ApiController;

abstract class Middleware extends ApiController
{
    abstract public function handle(callable $action): string;

}