<?php


namespace src\model;


use src\core\general\Communicate;
use src\session\Session;

class CommonModel extends BaseModel
{
    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 2;
    public const TYPE_ENTRY = 1;

    public const USER_LOG_SES_NAME = 'userLoginSes';

    public function getMenuData()
    {
        return $this->db->select("*")->from($this->tables->user)->getAll();
    }

    public function getCommunicateData()
    {
        $pCommunicate = $this->session->get(Communicate::C_POSITIVE);
        $nCommunicate = $this->session->get(Communicate::C_NEGATIVE);
        if (!empty($pCommunicate)) {
            $this->data[Communicate::C_POSITIVE] = $pCommunicate;
            $this->session->remove(Communicate::C_POSITIVE);
        }
        if (!empty($nCommunicate)) {
            $this->data[Communicate::C_NEGATIVE] = $nCommunicate;
            $this->session->remove(Communicate::C_NEGATIVE);
        }
    }

    public function getBaseData()
    {
        $this->getCommunicateData();
    }

    public function getData(): array
    {
        $this->getBaseData();
        return $this->data;
    }

    protected function checkIfUserExists(): array
    {
        $user = $this->db->select('*')->from($this->tables->user)->where('email', '=', $this->email)->getAll();
        return $user;
    }
}