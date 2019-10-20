<?php


namespace src\Installation\Database;


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
        $this->config = Config::getConfig();
    }

    /**
     * @return object
     */
    public function getTables(): object
    {
        $tables = new \stdClass();
        foreach (self::TABLES as $table) {
            $tables->{$table} = $this->config['db_prefix'] . $table;
        }
        return $tables;
    }
}