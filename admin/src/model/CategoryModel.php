<?php

namespace admin\src\model;

use src\core\general\Password;
use src\core\general\Role;
use src\core\general\Status;
use src\core\validation\Validator;
use src\model\CommonModel;

class CategoryModel extends CommonModel
{
    protected $data = [];
    protected $name;
    protected $status;

    public function verifyInsertData(): bool
    {
        $this->name = $this->validate->set($this->request->post()->get('fName'), 'Name')
            ->filterValue()
            ->checkIfEmpty()
            ->validateText(2, 20)
            ->get();
        $this->status = $this->validate->set($this->request->post()->get('fStatus'), 'Status')
            ->filterValue()
            ->checkIfNumeric()
            ->get();
        $errors = $this->validate->getErrors();
        if (!empty($errors)) {
            $this->data[self::ERROR_LABEL] = $errors;
            return false;
        }
        return true;
    }

    public function checkIfNoExist(): bool
    {
        $cName = $this->validator->filterValue($this->request->post()->get('fName'));
        $category = $this->db->select("*")->from($this->tables->category)->where('name', '=', $cName)->getAll();
        if (empty($category)) {
            return true;
        }
        $this->data[self::ERROR_LABEL][] = 'Kategoria istnieje';
        return false;
    }

    public function insertItem()
    {
        $this->data[self::ACTION_INSERTED] = false;
        if ($this->verifyInsertData()) {
            if ($this->checkIfNoExist()) {
                if ($this->insert()) {
                    $this->data[self::ACTION_INSERTED] = true;
                }
            }
        }
        return $this;
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
        return $this->db->delete()->from($this->tables->category)->where('id', '=', $id)->execute();
    }


    protected function update(): bool
    {
        $id = $this->validator->filterValue($this->request->post()->get('fId'));
        $data = [
            'name' => $this->name,
            'status' => $this->status
        ];
        return $this->db->update($this->tables->category, $data)->where('id', '=', $id)->execute();
    }

    protected function insert(): bool
    {
        $data = [
            'name' => $this->name,
            'status' => $this->status
        ];
        return $this->db->insert($this->tables->category, $data)->execute();
    }

    public function getCategories(): object
    {
        $this->data['categories'] = $this->db->select('*')->from($this->tables->category)->getAll();
        return $this;
    }

    public function getCategory(): object
    {
        $id = $this->validator->filterValue($this->request->query()->get('id'));
        $this->data['categories'] = $this->db->select('*')->from($this->tables->category)->where('id', '=', $id)->getOne();
        return $this;
    }


}