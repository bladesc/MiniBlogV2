<?php


namespace src\core\db;


use src\config\config;

class Tables
{
    protected $config;

    public const TABLES = [
        'user',
        'category'
    ];

    public function __construct()
    {
        $this->config = (new Config())->getConfigContainer();
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