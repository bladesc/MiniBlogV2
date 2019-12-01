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

    public function verifyInsertData(): bool
    {
        $cName = $this->request->post()->get('cName');
        if (!empty($cName)) {
            if (!$this->validator->validateText($cName, 4, 12)) {
                $this->data['errors'][] = 'Zla nazwa, minum 4 znaki, maks 12, niedozwolone znaki';
                return false;
            }
        } else {
            $this->data['errors'][] = 'Nie wypelniles wszystkich pol';
            return false;
        }
        return true;
    }

    public function verifyUpdateData(): bool
    {
        $cNewName = $this->request->post()->get('cNewName');
        if (!empty($cNewName)) {
            if (!$this->validator->validateText($cNewName, 4, 12)) {
                $this->data['errors'][] = 'Zla nazwa, minum 4 znaki, maks 12, niedozwolone znaki';
                return false;
            }
        } else {
            $this->data['errors'][] = 'Nie wypelniles wszystkich pol';
            return false;
        }
        return true;
    }

    public function checkIfNoExist(): bool
    {
        $cName = $this->validator->filterValue($this->request->post()->get('cName'));
        $category = $this->db->select("*")->from($this->tables->category)->where('name', '=', $cName)->getAll();
        if (empty($category)) {
            return true;
        }
        $this->data['errors'][] = 'Kategoria istnieje';
        return false;
    }

    public function addCategory()
    {
        $this->data['catInserted'] = false;
        if ($this->verifyInsertData()) {
            if ($this->checkIfNoExist()) {
                if ($this->addCategoryToDb()) {
                    $this->data['catInserted'] = true;
                }
            }
        }
        return $this;
    }

    public function updateCategory()
    {
        $this->data['catUpdated'] = false;
        if ($this->verifyUpdateData()) {
            if ($this->updateCategoryToDb()) {
                $this->data['catUpdated'] = true;
            }
        }
        return $this;
    }

    public function deleteCategory()
    {
        $this->data['catDeleted'] = false;
        if ($this->deleteCategoryToDb()) {
            $this->data['catDeleted'] = true;
        }
        return $this;
    }

    protected function deleteCategoryToDb(): bool
    {
        $id = $this->validator->filterValue($this->request->post()->get('cId'));
        return $this->db->delete()->from($this->tables->category)->where('id', '=', $id)->execute();
    }


    protected function updateCategoryToDb(): bool
    {
        $cNewName = $this->validator->filterValue($this->request->post()->get('cNewName'));
        $id = $this->validator->filterValue($this->request->post()->get('cId'));
        $data = [
            'name' => $cNewName,
        ];
        return $this->db->update($this->tables->category, $data)->where('id', '=', $id)->execute();
    }

    protected function addCategoryToDb(): bool
    {
        $cName = $this->validator->filterValue($this->request->post()->get('cName'));
        $data = [
            'name' => $cName,
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