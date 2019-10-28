<?php

namespace src\core\db;

class Query
{
    protected $conn;
    protected $sth;

    public function __construct()
    {
        $this->conn = (new Connection())->getConnection();
    }
}