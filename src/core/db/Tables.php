<?php


namespace src\core\db;


use src\config\config;

class Tables
{
    protected $config;

    public const TABLES = [
        'user',
        'user_details',
        'user_remind',
        'category',
        'entry',
        'tag',
        'setting',
        'role',
        'privilege',
        'page',
        'page_seo',
        'login',
        'image',
        'gallery'
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