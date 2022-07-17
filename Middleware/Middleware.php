<?php
namespace LibraryApi\Middleware;

abstract class Middleware
{
    abstract public function handle(callable $action): string;

    protected function getQueryParam(string $param)
    {
        return $_GET[$param] ?? null;
    }

}