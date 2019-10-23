<?php

namespace Installation;

use src\Core\Db\Connection;
use src\Config\Config;
use Installation\Database\Table;
use Installation\Database\Data;
use src\Core\Db\Tables;

class Install
{
    protected $config;

    protected $database;
    protected $table;
    protected $data;

    protected $queries = [];
    protected $tables;

    protected $conn;

    public function __construct()
    {
        $this->config = Config::getConfig();
        $this->conn = (new Connection())->getConnection();
        $this->tables = (new Tables)->getTables();
        $this->table = new Table($this->tables);
        $this->data = new Data($this->tables);
    }

    public function install(): bool
    {
        try {
            $this->conn->beginTransaction();
            $this->prepareTables();
            $this->prepareData();
            $this->run();
            $this->conn->commit();
            return true;
        } catch (\Exception $e) {
            echo $e->getMessage();
            $this->conn->rollBack();
            return false;
        }
    }

    protected function prepareTables()
    {
        $this->queries = array_merge($this->table->getQueries(), $this->queries);
    }

    public function prepareData()
    {
        $this->queries = array_merge($this->data->getQueries(), $this->queries);
    }

    public function run()
    {
        foreach ($this->queries as $query) {
            $sth = $this->conn->prepare($query);
            $sth->execute();
        }
    }
}