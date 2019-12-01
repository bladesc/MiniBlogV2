<?php


namespace src\model;


use src\core\general\Communicate;
use src\session\Session;

class CommonModel extends BaseModel
{
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
}