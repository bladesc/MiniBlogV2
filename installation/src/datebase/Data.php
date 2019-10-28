<?php

namespace installation\src\database;

class Data
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
        $queries[] =';';
    }
}