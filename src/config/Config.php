<?php

namespace src\config;

class Config
{
    protected $config;
    protected $configContainer = [];


    public function __construct()
    {
        include('Database.php');
        include('Global.php');
        include('Installation.php');
        $this->configContainer = $config;
    }

    public function getConfigContainer(): array
    {
        return $this->configContainer;
    }

    public function getConfigConnection(array $configConnection = []): array
    {
        return (!empty($configConnection)) ? $configConnection : $this->configContainer['db'];
    }

}