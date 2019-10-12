<?php

namespace src\Config;

class Config
{
    protected static $config;
    protected $configContainer = [];

    public function __construct()
    {
        include('Database.php');
        include('Global.php');
        $this->configContainer = $config;
    }

    public function getConfigContainer()
    {
        return $this->configContainer;
    }

    public static function getConfig()
    {
        if (self::$config === null) {
            self::$config = new Config();
        }
        return self::$config;
    }

}