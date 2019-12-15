<?php


namespace admin\src\model;


use src\model\CommonModel;

class LogModel extends CommonModel
{
    protected $data = [];

    public function getLogs()
    {
        $this->data['logs'] = $this->db->select('*')->from($this->tables->log)->getAll();
        return $this;
    }

    public function getLog(): object
    {
        $id = $this->validator->filterValue($this->request->query()->get('id'));
        $this->data['logs'] = $this->db->select('*')->from($this->tables->log)->where('id', '=', $id)->getOne();
        return $this;
    }

    public function deleteItem()
    {
        $this->data[self::ACTION_DELETED] = false;
        if ($this->delete()) {
            $this->data[self::ACTION_DELETED] = true;
        }
        return $this;
    }

    protected function delete(): bool
    {
        $id = $this->validator->filterValue($this->request->post()->get('fId'));
        return $this->db->delete()->from($this->tables->log)->where('id', '=', $id)->execute();
    }
}