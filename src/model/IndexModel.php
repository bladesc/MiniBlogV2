<?php


namespace src\model;


class IndexModel extends CommonModel
{
    protected $data = [];

    public function logout()
    {
        $this->data[CommonModel::ACTION_LOGOUT] = false;
        if ($this->session->remove(self::USER_LOG_SES_NAME)) {
            $this->data[CommonModel::ACTION_LOGOUT] = true;
        }
        return $this;

    }
}