<?php

namespace LibraryApi\Microkernel\Module;

use LibraryApi\Microkernel\Container\ContainerInterface;

abstract class BaseModule
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    public function setContainer(ContainerInterface $container): void
    {
        $this->container = $container;
    }
}