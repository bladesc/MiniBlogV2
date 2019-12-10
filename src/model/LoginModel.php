<?php


namespace src\model;


use src\core\general\Password;

class LoginModel extends CommonModel
{
    protected $email;
    protected $password;
    protected $userDbData;

    protected $data = [];

    public function verifyLoginData()
    {
        $this->email = $this->validate->set($this->request->post()->get('fEmail'), 'Email')
            ->filterValue()
            ->checkIfEmpty()
            ->validateText(4, 20)
            ->get();
        $this->userDbData = $this->checkIfUserExists();
        if (empty($this->userDbData)) {
            $this->data['errors'][] = 'Uzytkownik nie istnieje';
            return false;
        }
        $this->password = $this->validate->set($this->request->post()->get('fPassword'), 'Password')
            ->filterValue()
            ->checkIfEmpty()
            ->validateText(6, 20)
            ->get();
        $errors = $this->validate->getErrors();
        if (!empty($errors)) {
            $this->data['errors'] = $errors;
            return false;
        }
        if (!Password::verify($this->password, $this->userDbData[0]['password'])) {
            $this->data['errors'] = 'Haslo lub email jest nieprawidlowy';
            return false;
        }
        return true;
    }

    public function loginUser()
    {
        $this->data['userLogged'] = false;
        if ($this->verifyLoginData()) {
            if ($this->processLoginUser()) {
                $this->data['userLogged'] = true;
            }
        }
        return $this;
    }

    public function processLoginUser()
    {
        return $this->session->change(self::USER_LOG_SES_NAME,[$this->userDbData[0]['id'], $this->userDbData[0]['email']]);
    }
}