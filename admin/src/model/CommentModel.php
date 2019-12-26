<?php


namespace admin\src\model;


use src\core\helper\Helper;
use src\model\CommonModel;

class CommentModel extends CommonModel
{
    protected $data = [];

    protected $id;
    protected $content;
    protected $userId;
    protected $entryId;

    public function verifyInsertData(): bool
    {
        $this->content = $this->validate->set($this->request->post()->get('fContent'), $this->translations->pl['tableContent'])
            ->filterValue()
            ->checkIfEmpty()
            ->validateText(2, 20)
            ->get();
        $errors = $this->validate->getErrors();
        if (!empty($errors)) {
            $this->data[self::ERROR_LABEL] = $errors;
            return false;
        }
        return true;
    }

    public function getComments()
    {
        $this->data['comments'] = $this->db->select('*')->from($this->tables->comment)->getAll();
        return $this;
    }

    public function getComment(): object
    {
        $id = $this->validator->filterValue($this->request->query()->get('id'));
        $this->data['comments'] = $this->db->select('*')->from($this->tables->comment)->where('id', '=', $id)->getOne();
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
        return $this->db->delete()->from($this->tables->comment)->where('id', '=', $id)->execute();
    }

    protected function update(): bool
    {
        $id = $this->validator->filterValue($this->request->post()->get('fId'));
        $data = [
            'content' => $this->content,
            'updated_at' => Helper::now()
            ];
        return $this->db->update($this->tables->comment, $data)->where('id', '=', $id)->execute();
    }

    public function updateItem()
    {
        $this->data[self::ACTION_UPDATED] = false;
        if ($this->verifyInsertData()) {
            if ($this->update()) {
                $this->data[self::ACTION_UPDATED] = true;
            }
        }
        return $this;
    }
}