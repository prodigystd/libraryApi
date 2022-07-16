<?php

namespace LibraryApi\Microkernel\Module;

use LibraryApi\Microkernel\Container\ContainerInterface;

interface ModuleInterface
{
    public function setContainer(ContainerInterface $container);

    public function register();

    public function boot();
}