<?php

namespace admin\src\model;

use src\core\general\Password;
use src\core\general\Role;
use src\core\general\Status;
use src\model\CommonModel;

class CategoryModel extends CommonModel
{
    protected $data = [];

    public function verifyData(): bool
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
        if ($this->verifyData()) {
            if ($this->checkIfNoExist()) {
                if ($this->addCategoryToDb()) {
                    $this->data['catInserted'] = true;
                }
            }
        }
        return $this;
    }


    protected function addCategoryToDb(): bool
    {
        $cName = $this->validator->filterValue($this->request->post()->get('cName'));
        $data = [
            'name' => $cName,
        ];
        return $this->db->insert($this->tables->category, $data)->execute();
    }

}