<?php
namespace LibraryApi\Middleware;

use LibraryApi\Microkernel\Container\Container;
use LibraryApi\Microkernel\Microkernel;
use LibraryApi\Modules\Database\DatabaseDriverInterface;
use LibraryApi\Modules\Database\DatabaseModule;

class TestCheckMiddleware extends Middleware
{
    public function handle(callable $action): string
    {
        if ($this->getQueryParam('is_test')) {
            // set up test database connection
            /** @var Microkernel $microkernel */
            $microkernel = Container::instance()->make(Microkernel::class);
            /** @var DatabaseModule $databaseModule */
            $databaseModule = $microkernel->getModule(DatabaseModule::class);
            $databaseModule->registerTest();
        }
        return $action();
    }
}