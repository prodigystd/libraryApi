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
        /** @var DatabaseDriverInterface $database */
        $database = new MySqlDriver();
        $database->setConfig($this->config);
        $this->container->bind(DatabaseDriverInterface::class, $database);
    }

    public function useTestConfig()
    {
        $this->loadTestConfig();
        /** @var DatabaseDriverInterface $database */
        $database = $this->container->make(DatabaseDriverInterface::class);
        $database->setConfig($this->config);
    }

    public function boot()
    {

    }

    public function loadConfig()
    {
        $this->config = new Config(include dirname(__FILE__, 3) . "/Config/database.php");
    }

    public function loadTestConfig()
    {
        $this->config = new Config(include dirname(__FILE__, 3) . "/Config/test_database.php");
    }
}