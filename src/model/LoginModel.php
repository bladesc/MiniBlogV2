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
        $this->email = $this->validate->set($this->request->post()->get('fEmail'), $this->translations->pl['loginEmail'])
            ->filterValue()
            ->checkIfEmpty()
            ->validateText(4, 20)
            ->validateEmail()
            ->get();
        $this->userDbData = $this->checkIfUserExists();
        if (empty($this->userDbData)) {
            $this->data[self::ERROR_LABEL][] = $this->translations->pl['userNotExist'];
            return false;
        }
        $this->password = $this->validate->set($this->request->post()->get('fPassword'), $this->translations->pl['registerPassword'])
            ->filterValue()
            ->checkIfEmpty()
            ->validateText(6, 20)
            ->get();
        $errors = $this->validate->getErrors();
        if (!empty($errors)) {
            $this->data[self::ERROR_LABEL] = $errors;
            return false;
        }
        if (!Password::verify($this->password, $this->userDbData[0]['password'])) {
            $this->data[self::ERROR_LABEL][] = $this->translations->pl['badPassOrEmail'];
            return false;
        }
        return true;
    }

    public function loginUser()
    {
        $this->data[self::ACTION_LOGGED] = false;
        if ($this->verifyLoginData()) {
            if ($this->processLoginUser()) {
                $this->data[self::ACTION_LOGGED] = true;
            }
        }
        return $this;
    }

    public function processLoginUser()
    {
        return $this->session->change(self::USER_LOG_SES_NAME,[$this->userDbData[0]['id'], $this->userDbData[0]['email']]);
    }
}