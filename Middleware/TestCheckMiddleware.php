<?php
namespace LibraryApi\Middleware;

use LibraryApi\Modules\Database\DatabaseModule;

class TestCheckMiddleware extends Middleware
{
    public function handle(callable $action, DatabaseModule $databaseModule): string
    {
        if ($this->getQueryParam('is_test')) {
            $databaseModule->useTestConfig();
        }
        return $action();
    }
}