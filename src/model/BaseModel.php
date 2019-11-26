<?php

namespace src\model;

use src\config\Config;
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
    protected $configContainer;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->configContainer = (new Config())->getConfigContainer();
        $this->db = new QueryHelper();
        $this->tables = (new Tables())->getTables();
    }
}