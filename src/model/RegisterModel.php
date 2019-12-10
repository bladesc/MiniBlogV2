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
        $this->nick = $this->validate->set($this->request->post()->get('fNick'), 'Nick')->filterValue()->checkIfEmpty()->validateText(4, 20)->get();
        $this->email = $this->validate->set($this->request->post()->get('fEmail'), 'Email')->filterValue()->checkIfEmpty()->validateText(4, 20)->get();
        $this->passwordProve = $this->validate->set($this->request->post()->get('fPasswordProve'), 'Password')->checkIfEmpty()->filterValue()->validateText(6, 20)->get();
        $this->password = $this->validate->set($this->request->post()->get('fPassword'), 'PasswordProve')->filterValue()->checkIfEmpty()->validateText(6, 20)->comparePasswords($this->passwordProve)->get();
        $errors = $this->validate->getErrors();
        if (!empty($errors)) {
            $this->data['errors'] = $errors;
            return false;
        }
        if (!empty($this->checkIfUserExists())) {
            $this->data['errors'][] = 'Uzytkownik z taki madresem email juz istnieje';
            return false;
        }
        return true;
    }

    public function addUser()
    {
        $this->data['userInserted'] = false;
        if ($this->verifyInsertData()) {
            if ($this->addUserToDb()) {
                $this->data['userInserted'] = true;
            }
        }
        return $this;
    }

    public function addUserToDb()
    {
        $data = [
            'nick' => $this->nick,
            'email' => $this->email,
            'password' => Password::hash($this->password),
            'status' => self::STATUS_ACTIVE,
            'role_id' => Role::ROLE_USER,
            'created_at' => Helper::now(),
            'updated_at' => Helper::now(),
        ];
        return $this->db->insert($this->tables->user, $data)->execute();
    }
}