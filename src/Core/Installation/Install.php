<?php

use src\Config\Config;
use Core\Db\QueryHelper;
class Install
{
    protected $config;
    protected $conn;
    protected $db;

    public function __construct()
    {
        $this->config = Config::getConfig();
        $this->db = new QueryHelper();
    }

    public function checkIfInstalled(): bool
    {
        if (empty($this->db
            ->select("*")
            ->from("user")
            ->execute())) {
            return false;
        }
        return true;
    }
}