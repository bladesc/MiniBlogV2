<?php

namespace src\core\permission;

use src\core\db\QueryHelper;
use src\core\db\Tables;
use src\core\redirect\Redirect;
use src\model\CommonModel;
use src\session\Session;

class Permission
{
    protected $session;
    protected $defaultUrl = 'index.php?page=index';
    protected $role;
    protected $userId;
    protected $db;
    protected $tables;
    protected $userRole;

    public function __construct()
    {
        $this->session = new Session();
        $this->db = new QueryHelper();
        $this->tables = (new Tables())->getTables();
        $this->getDataFromSession();
    }

    protected function getDataFromSession()
    {
        $this->userId = $this->session->get(CommonModel::USER_LOG_SES_NAME)[0];
        if (isset($this->userId) && $this->userId !== null) {
            $this->userRole = ($this->db->select(['role_id'])->from($this->tables->user)->where('id', '=',$this->userId)->getOne())['role_id'];
        } else {
            $this->userRole = null;
        }
    }

    public function setRole(int $role)
    {
        $this->role = $role;
        return $this;
    }

    public function checkPermission()
    {
        if ($this->userRole === $this->role) {
            return true;
        }
        Redirect::redirectTo($this->defaultUrl);
        return false;
    }


}