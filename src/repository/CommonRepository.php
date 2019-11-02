<?php


namespace src\repository;


class CommonRepository extends BaseRepository
{
    public function getMenuData()
    {
        $this->data['navbar'] =  $this->db->select("*")->from($this->tables->user)->execute();
    }
}