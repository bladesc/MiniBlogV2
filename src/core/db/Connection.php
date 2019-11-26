<?php

namespace src\core\db;

use src\config\config;

class Connection
{
    protected $options;
    protected $configConnection;

    protected $conn = null;
    protected $sth;

    /**
     * Connection constructor.
     * @param config|null $configConnection
     */
    public function __construct($configConnection = null)
    {
        $this->configConnection = $configConnection ?? (new Config())->getConfigConnection();
        $this->setOptions();
        $dsn = "mysql:host=" . $this->configConnection['hostname'] . ";dbname=" . $this->configConnection['name'] . ";charset=" . $this->configConnection['charset'];
        try {
            if ($this->conn === null) {
                $this->conn = new \PDO($dsn, $this->configConnection['username'], $this->configConnection['password'], $this->options);
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
