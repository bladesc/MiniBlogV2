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

    public function getEntries()
    {
        $this->data[self::DATA_LABEL_ENTRIES] = $this->db->select([]);

    }

    public function getPages()
    {
        $this->data[self::DATA_LABEL_PAGES] = $this->db->select(['name', 'url'])
            ->from($this->tables->page)
            ->where('status', '=', self::STATUS_ACTIVE)
            ->getAll();
    }
}