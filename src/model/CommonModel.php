<?php


namespace src\model;


class CommonModel extends BaseModel
{
    public function getMenuData()
    {
        return $this->db->select("*")->from($this->tables->user)->getAll();
    }
}