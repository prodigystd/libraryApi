<?php

namespace LibraryApi\Microkernel;

use LibraryApi\Microkernel\Container\ContainerInterface;
use LibraryApi\Microkernel\Module\ModuleInterface;

interface MicrokernelInterface
{
    public function boot(ContainerInterface $container): void;

    public function getModule(string $moduleClass): ?ModuleInterface;
}