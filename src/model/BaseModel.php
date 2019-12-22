<?php

namespace src\model;

use src\config\Config;
use src\core\db\QueryHelper;
use src\core\db\Tables;
use src\core\general\Paginator;
use src\core\general\Remind;
use src\core\request\Request;
use src\core\validation\FileValidate;
use src\core\validation\Validate;
use src\core\validation\Validator;
use src\session\Session;
use src\core\email\Emailer;


class BaseModel
{
    protected $repository;
    protected $data = [];
    protected $db;
    protected $tables;
    protected $request;
    protected $configContainer;
    protected $validator;
    protected $session;
    protected $validate;
    protected $emailer;
    protected $fileValidate;
    protected $paginator;

    public function __construct(Request $request, bool $installationStatus = true)
    {
        $this->request = $request;
        $this->configContainer = (new Config())->getConfigContainer();
        $this->tables = (new Tables())->getTables();
        $this->validator = new Validator();
        $this->validate = new Validate();
        $this->fileValidate = new FileValidate($this->validate);
        if ($installationStatus) {
            $this->db = new QueryHelper();
        }
        $this->paginator = new Paginator();
        $this->session = new Session();
        $this->emailer = new Emailer();
        $this->remind = new Remind();

    }
}