<?php


namespace src\model;


use src\core\helper\Helper;
use src\core\general\Role;
use src\core\general\Password;

class RegisterModel extends CommonModel
{
    protected $nick;
    protected $email;
    protected $password;
    protected $passwordProve;

    protected $data = [];

    public function verifyInsertData()
    {
        $this->nick = $this->validate->set($this->request->post()->get('fNick'), 'Nick')
            ->filterValue()
            ->checkIfEmpty()
            ->validateText(4, 20)
            ->get();
        $this->email = $this->validate->set($this->request->post()->get('fEmail'), 'Email')
            ->filterValue()
            ->checkIfEmpty()
            ->validateText(4, 20)
            ->validateEmail()
            ->get();
        $this->passwordProve = $this->validate->set($this->request->post()->get('fPasswordProve'), 'Password')
            ->filterValue()
            ->checkIfEmpty()
            ->validateText(6, 20)
            ->get();
        $this->password = $this->validate->set($this->request->post()->get('fPassword'), 'PasswordProve')
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
        if (!empty($this->checkIfUserExists())) {
            $this->data[self::ERROR_LABEL][] = 'Uzytkownik z taki madresem email juz istnieje';
            return false;
        }
        return true;
    }

    public function addUser()
    {
        $this->data[self::ACTION_INSERTED] = false;
        if ($this->verifyInsertData()) {
            if ($this->insert()) {
                $this->data[self::ACTION_INSERTED] = true;
            }
        }
        return $this;
    }

    public function insert()
    {
        $this->db->beginTransactions();
        try {
            $data = [
                'nick' => $this->nick,
                'email' => $this->email,
                'password' => Password::hash($this->password),
                'status' => self::STATUS_ACTIVE,
                'role_id' => Role::ROLE_USER,
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
            $this->db->rollback();
            return false;
        }
        return true;
    }
}