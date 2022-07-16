<?php

namespace LibraryApi\Modules\Database;

use LibraryApi\Microkernel\Module\BaseModule;
use LibraryApi\Microkernel\Module\ModuleInterface;

class DatabaseModule extends BaseModule implements ModuleInterface
{
    /**
     * @var Config
     */
    private $config;

    public function register()
    {
        $this->loadConfig();
        /** @var DataBaseDriverInterface $database */
        $database = new MySqlDriver();
        $database->setConfig($this->config);
        $this->container->bind(DataBaseDriverInterface::class, $database);
    }

    public function boot()
    {

    }

    public function loadConfig()
    {
        $this->config = new Config(include dirname(__FILE__, 3) . "/Config/database.php");
    }
}