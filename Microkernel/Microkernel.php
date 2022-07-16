<?php

namespace LibraryApi\Microkernel;

use LibraryApi\Microkernel\Container\Container;
use LibraryApi\Microkernel\Container\ContainerInterface;
use LibraryApi\Microkernel\Module\ModuleInterface;

class Microkernel
{

    /**
     * @var string[]
     */
    private $moduleClasses;

    /**
     * @var ModuleInterface[]
     */
    private $modules;

    private function loadModules(): void
    {
        $this->moduleClasses = include dirname(__FILE__, 2) . "/Config/modules.php";
    }


    public function boot(): void
    {
        $this->loadModules();

        /** @var ContainerInterface $container */
        $container = Container::instance();
        foreach ($this->moduleClasses as $moduleClass) {
            $module = new $moduleClass;
            $module->setContainer($container);
            $module->register();
            $this->modules[] = $module;
        }

        foreach ($this->modules as $module) {
            $module->boot();
        }

    }

}