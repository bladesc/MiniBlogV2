<?php


namespace src\model;


class IndexModel extends CommonModel
{
    protected $data = [];

    public function logout()
    {
        $this->data['userLogout'] = false;
        if ($this->session->remove(self::USER_LOG_SES_NAME)) {
            $this->data['userLogout'] = true;
        }
        return $this;

    }
}