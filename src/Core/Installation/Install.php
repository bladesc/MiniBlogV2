<?php

use src\Config\Config;
use Core\Db\Connection;

class Install
{
    protected $config;
    protected $conn;

    public function __construct()
    {
        $this->config = Config::getConfig();
        $this->conn = (new Connection())->getConnection();
    }

public
}