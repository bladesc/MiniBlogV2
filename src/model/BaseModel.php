<?php

namespace src\model;

use src\core\db\QueryHelper;
use src\core\db\Tables;
use src\core\request\Request;

class BaseModel
{
    protected $repository;
    protected $data = [];
    protected $db;
    protected $tables;
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->db = new QueryHelper();
        $this->tables = (new Tables())->getTables();
    }
}