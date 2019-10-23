<?php


namespace src\Core\Db;


use src\Config\Config;

class Tables
{
    protected $config;

    public const TABLES = [
      'user',
      'avatar'
    ];

    public function __construct()
    {
        $this->config = (Config::getConfig())->getConfigContainer();
    }

    /**
     * @return object
     */
    public function getTables(): object
    {
        $tables = new \stdClass();
        foreach (self::TABLES as $table) {
            $tables->{$table} = $this->config['db']['prefix'] . $table;
        }
        return $tables;
    }
}