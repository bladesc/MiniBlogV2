<?php

namespace installation\src\installation;

use src\core\db\connection;
use src\config\config;
use installation\src\installation\table;
use installation\src\installation\data;
use src\core\db\tables;

class Install
{
    protected $configContainer;

    protected $database;
    protected $table;
    protected $data;

    protected $queries = [];
    protected $tables;

    protected $conn;

    public function __construct()
    {
        $this->configContainer = (new Config())->getConfigContainer();
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

    protected function prepareTables(): void
    {
        $this->queries = array_merge($this->table->getQueries(), $this->queries);
    }

    public function prepareData(): void
    {
        $this->queries = array_merge($this->data->getQueries(), $this->queries);
    }

    public function run(): void
    {
        foreach ($this->queries as $query) {
            $sth = $this->conn->prepare($query);
            $sth->execute();
        }
    }
}