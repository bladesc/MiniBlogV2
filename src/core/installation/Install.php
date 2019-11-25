<?php

namespace src\core\installation;

use src\config\config;
use src\core\db\tables;
use src\core\db\queryHelper;

class Install
{
    protected $config;
    protected $db;
    protected $tables;

    public function __construct()
    {
        $this->config = (Config::getConfig())->getConfigContainer();
        $this->db = new QueryHelper();
        $this->tables = (new Tables())->getTables();
    }

    public function getCheckInstallDir(): bool
    {
        return ($this->config['inst']['checkInstallDir'] === true) ? true : false;
    }

    public function checkIfInstalled(): bool
    {
        try {
            $this->db->select("*")->from($this->tables->user)->execute();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}