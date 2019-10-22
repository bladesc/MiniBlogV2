<?php

namespace Installation;

use src\Core\Db\Connection;
use src\Config\Config;
use Installation\Database\Table;
use Installation\Database\Data;
use Installation\Database\Tables;

class Install
{
    protected $config;

    protected $database;
    protected $table;
    protected $data;

    protected $queries;
    protected $tables;

    /**
     * @param Config $config
     */
    public function setConfig(Config $config): void
    {
        $this->config = $config;
    }

    protected $conn;

    public function __construct()
    {
        $this->config = Config::getConfig();
        $this->conn = (new Connection())->getConnection();
        $this->tables = (new Tables)->getTables();
        $this->table = new Table();
        $this->data = new Data();
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
        }
    }

    public function prepareTables()
    {
        $this->queries[] = "CREATE TABLE $this->tables->user (
                   id INT NOT NULL AUTO_INCREMENT,
                   name VARCHAR(255) NOT NULL,
                   surname VARCHAR(255) NOT NULL,
                   nick VARCHAR(255),
                   status INT NOT NULL,
                   PRIMARY KEY (id)
                )";
        //user
        //avatar
        //role
        //privileges
        //log
        //password
        //config
    }

    public function prepareData()
    {
        $this->queries = "INSERT INTRO";

    }

    public function run()
    {
        $queries = '';
        foreach ($this->queries as $query) {
            $queries .= $query;
        }
        $sth = $this->conn->prepare($queries);
        $sth->execute();
    }
}