<?php

namespace Installation\Database;

class Table
{
    protected $queries = [];
    protected $tables;

    public function __construct($tables)
    {
        $this->tables = $tables;
        $this->prepareQueries();
    }

    public function getQueries(): array
    {
        return $this->queries;
    }

    public function prepareQueries()
    {
        //user
        $this->queries[] ='CREATE TABLE ' . $this->tables->user . ' (
                   id INT NOT NULL AUTO_INCREMENT,
                   name VARCHAR(255) NOT NULL,
                   surname VARCHAR(255) NOT NULL,
                   nick VARCHAR(255),
                   status INT NOT NULL,
                   PRIMARY KEY (id)
                );';
        //user
        //avatar
        //role
        //privileges
        //log
        //password
        //config
    }
}