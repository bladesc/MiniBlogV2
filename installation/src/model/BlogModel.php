<?php

namespace installation\src\model;

use src\core\db\QueryHelper;
use src\core\general\Password;
use src\core\general\Role;
use src\core\general\Status;
use src\core\helper\Helper;
use src\core\request\Request;
use src\model\CommonModel;

class BlogModel extends CommonModel
{
    protected $validator;
    protected $userName;
    protected $email;
    protected $password;
    protected $passwordProve;

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
        $this->userName = $this->validate->set($this->request->post()->get('bUserName'), 'Username')
            ->filterValue()
            ->checkIfEmpty()
            ->validateText(4, 20)
            ->get();
        $this->email = $this->validate->set($this->request->post()->get('bUserEmail'), 'Email')
            ->filterValue()
            ->checkIfEmpty()
            ->validateText(4, 50)
            ->validateEmail()
            ->get();
        $this->passwordProve = $this->validate->set($this->request->post()->get('bUserPasswordProve'), 'PasswordProve')
            ->filterValue()
            ->checkIfEmpty()
            ->validateText(6, 20)
            ->get();
        $this->password = $this->validate->set($this->request->post()->get('bUserPassword'), 'Password')
            ->filterValue()
            ->checkIfEmpty()
            ->validateText(6, 20)
            ->comparePasswords($this->passwordProve)
            ->get();
        $errors = $this->validate->getErrors();
        if (!empty($errors)) {
            $this->data[self::ERROR_LABEL] = $errors;
            return false;
        }
        return true;
    }

    protected function addUserToDb(): bool
    {
        $this->db->beginTransactions();
        try {
            $data = [
                'nick' => $this->userName,
                'email' => $this->email,
                'password' => Password::hash($this->password),
                'status' => Status::STATUS_ACTIVE,
                'role_id' => Role::ROLE_ADMIN,
                'created_at' => Helper::now(),
                'updated_at' => Helper::now(),
            ];
            $this->db->insert($this->tables->user, $data)->execute();
            $userId = $this->db->getLastInsertId();
            $data = [
                'firstname' => '',
                'surname' => '',
                'birthday' => '',
                'user_id' => $userId
            ];
            $this->db->insert($this->tables->user_details, $data)->execute();
            $data = [
                'remind_string' => '',
                'user_id' => $userId
            ];
            $this->db->insert($this->tables->user_remind, $data)->execute();
            $this->db->commit();
        } catch (\Exception $e) {
            $this->data[self::ERROR_LABEL][] = 'Some problem with inserting data';
            $this->db->rollback();
            return false;
        }
        return true;
    }

    public function getData(): array
    {
        return $this->data;
    }
}