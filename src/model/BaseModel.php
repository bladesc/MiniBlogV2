<?php

namespace src\model;

use src\config\Config;
use src\core\db\QueryHelper;
use src\core\db\Tables;
use src\core\request\Request;
use src\core\validation\Validator;

class BaseModel
{
    protected $repository;
    protected $data = [];
    protected $db;
    protected $tables;
    protected $request;
    protected $configContainer;
    protected $validator;

    public function __construct(Request $request, bool $installationStatus = true)
    {
        $this->request = $request;
        $this->configContainer = (new Config())->getConfigContainer();
        $this->tables = (new Tables())->getTables();
        $this->validator = new Validator();
        if ($installationStatus) {
            $this->db = new QueryHelper();
        }
    }
}