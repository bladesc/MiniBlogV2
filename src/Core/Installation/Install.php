<?php

namespace src\Core\Installation;

use src\Config\Config;
use src\Core\Db\Tables;
use src\Core\Db\QueryHelper;

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
        return ($this->config['inst']['checkInstallDir'] === 'true') ? true : false;
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