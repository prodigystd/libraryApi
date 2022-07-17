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


    public function boot(ContainerInterface $container): void
    {
        $this->loadModules();

        $container->bind(static::class, $this);
        foreach ($this->moduleClasses as $moduleClass) {
            $module = new $moduleClass;
            $module->setContainer($container);
            $module->register();
            $this->modules[$moduleClass] = $module;
        }

        foreach ($this->modules as $module) {
            $module->boot();
        }

    }

    public function getModule(string $moduleClass): ?ModuleInterface
    {
        return $this->modules[$moduleClass] ?? null;
    }

}