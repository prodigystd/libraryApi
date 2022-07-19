<?php
namespace LibraryApi\Middleware;

use LibraryApi\Microkernel\Container\Container;
use LibraryApi\Microkernel\MicrokernelInterface;
use LibraryApi\Modules\Database\DatabaseModule;

class TestCheckMiddleware extends Middleware
{
    public function handle(callable $action): string
    {
        if ($this->getQueryParam('is_test')) {
            // set up test database connection
            /** @var MicrokernelInterface $microkernel */
            $microkernel = Container::instance()->make(MicrokernelInterface::class);
            /** @var DatabaseModule $databaseModule */
            $databaseModule = $microkernel->getModule(DatabaseModule::class);
            $databaseModule->useTestConfig();
        }
        return $action();
    }
}