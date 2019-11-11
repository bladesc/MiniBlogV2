<?php


namespace src\core\db;


use src\config\Config;

class QueryHelper extends QueryBuilder
{
    public function checkConnection($dbHost,$dbName,$dbUser,$dbPassword)
    {
        $this->config = (Config::getConfig())->getConfigContainer();
        $this->setOptions();
        $dsn = "mysql:host=" . $this->config['db']['hostname'] . ";dbname=" . $this->config['db']['name'] . ";charset=" . $this->config['db']['charset'];
        try {
            if ($this->conn === null) {
                $this->conn = new \PDO($dsn, $this->config['db']['username'], $this->config['db']['password'], $this->options);
            }
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}