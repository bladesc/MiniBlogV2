<?php

namespace installation\src\model;
use src\core\db\QueryHelper;
use src\core\general\Role;
use src\core\general\Status;
use src\core\request\Request;
use src\model\CommonModel;

class BlogModel extends CommonModel
{
    protected $validator;

    protected $data = [];

    public function addUser()
    {
        $this->data['userInserted'] = false;
        if ($this->verifyUser()) {
            if ($this->addUserToDb()) {
                $this->data['userInserted'] = true;
            }
        }
        return $this;
    }

    protected function verifyUser(): bool
    {
        $uName = $this->request->post()->get('bUserName');
        $uEmail = $this->request->post()->get('bUserEmail');
        $uPassword = $this->request->post()->get('bUserPassword');
        $uPasswordProve = $this->request->post()->get('bUserPasswordProve');
        if (!empty($uName) && !empty($uEmail) && !empty($uPassword) && !empty($uPasswordProve)) {
            if (!$this->validator->validateText($uName, 4,12)){
                $this->data['errors'][] = 'Zly nick, minum 4 znaki, maks 12, niedozwolone znaki';
                return false;
            }
            if (!$this->validator->validateEmail($uEmail)){
                $this->data['errors'][] = 'Zly email';
                return false;
            }
            if (!$this->validator->validatePassword($uPassword)){
                $this->data['errors'][] = 'Haslo za krotkie';
                return false;
            }
            if (!$this->validator->comparePasswords($uPassword, $uPasswordProve)){
                $this->data['errors'][] = 'Hasla nie sa takie same';
                return false;
            }
            return true;
        } else {
            $this->data['errors'][] = 'Nie wypelniles wszystkich pol';
            return false;
        }
    }

    protected function addUserToDb(): bool
    {
        $uName = $this->validator->filterValue($this->request->post()->get('bUserName'));
        $uEmail = $this->validator->filterValue($this->request->post()->get('bUserEmail'));
        $uPassword = $this->validator->filterValue($this->request->post()->get('bUserPassword'));
        $data = [
            'nick' => $uName,
            'email' => $uEmail,
            'password' => $uPassword,
            'idrole' => Role::ROLE_ADMIN,
            'status' => Status::STATUS_ACTIVE
        ];
        return $this->db->insert($this->tables->user, $data)->execute();
    }
}