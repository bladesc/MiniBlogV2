<?php

namespace Core\Db;

use src\Config\Config;

class Connection
{
    protected $options;
    protected $config;

    protected $conn;
    protected $sth;

    /**
     * Connection constructor.
     * @param $dbDriverName
     */
    public function __construct()
    {
        $this->config = Config::getConfig();
        $this->setOptions();
        $dsn = "mysql:host=$this->config['db_hostname'];dbname=$this->config['db_name'];charset=$this->config['db_charset']";
        try {
            if ($this->conn === null) {
                $this->conn = new \PDO($dsn, $this->config['db_username'], $this->config['db_password'], $this->options);
            }
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }


    /**
     *
     */
    public function setOptions(): void
    {
        $this->options = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];
    }

    /**
     * @return \PDO
     */
    public function getConnection()
    {
        return $this->conn;
    }
}
