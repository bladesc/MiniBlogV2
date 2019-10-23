<?php

namespace src\Core\Db;

class Query
{
    protected $conn;
    protected $sth;

    public function __construct()
    {
        $this->conn = (new Connection())->getConnection();
    }
}