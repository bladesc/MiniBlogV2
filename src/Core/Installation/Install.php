<?php

namespace src\Core\Installation;

use src\Config\Config;
use src\Core\Db\QueryHelper;

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
        try {
            $this->db->select("*")->from("user")->execute();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}