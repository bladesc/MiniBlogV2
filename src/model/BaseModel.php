<?php

namespace src\model;

use src\core\db\QueryHelper;
use src\core\db\Tables;

class BaseModel
{
    protected $repository;
    protected $data = [];
    protected $db;
    protected $tables;

    public function __construct()
    {
        $this->db = new QueryHelper();
        $this->tables = (new Tables())->getTables();
    }
}