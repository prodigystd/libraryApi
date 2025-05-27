<?php
namespace LibraryApi\Middleware;

use LibraryApi\Modules\Database\DatabaseModule;
use LibraryApi\Modules\Router\SystemMiddleware\BaseMiddleware;

class TestCheckMiddleware extends BaseMiddleware
{
    public function __construct(private DatabaseModule $databaseModule)
    {
    }

    public function handle(...$args): string
    {
        if ($this->getQueryParam('is_test')) {
            $this->databaseModule->useTestConfig();
        }
        return parent::handle();
    }
}