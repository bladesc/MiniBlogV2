<?php


namespace admin\src\model;


use src\model\CommonModel;

class AccountModel extends CommonModel
{
    protected $data = [];

    public function getAccounts()
    {
        $this->data['accounts'] = $this->db->select('*')
            ->from($this->tables->user)
            ->leftJoin($this->tables->user, 'user_details_id',$this->tables->user_details,'id')
            ->leftJoin($this->tables->user, 'role_id',$this->tables->role,'id')
            ->getAll();
        return $this;
    }
}