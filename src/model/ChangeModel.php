<?php


namespace src\model;


use src\core\general\Password;
use src\session\Session;

class ChangeModel extends CommonModel
{
    protected $oldPassword;
    protected $newPassword;
    protected $newPasswordProve;
    protected $id;
    protected $email;

    protected $data = [];

    public function changePassword()
    {
        $this->data['passwordChanged'] = false;
        if ($this->verifyPasswordData()) {
            if ($this->processChangePassword()) {
                $this->data['passwordChanged'] = true;
            }
        }
        return $this;
    }

    public function verifyPasswordData()
    {
        $userSessionData = $this->session->get(self::USER_LOG_SES_NAME);
        if (!empty($userSessionData[0]) || $userSessionData[0] == 0) {
            $this->id = (int)$userSessionData[0];
            $this->email = (string)$userSessionData[1];
        } else {
            $this->data[self::ERROR_LABEL] = 'User jest niezalogowany';
            return false;
        }
        $this->oldPassword = $this->validate->set($this->request->post()->get('fOldPassword'), 'Old password')
            ->filterValue()
            ->checkIfEmpty()
            ->validateText(6, 20)
            ->get();
        $user = ($this->checkIfUserExists())[0];
        if (!Password::verify($this->oldPassword, $user['password'])) {
            $this->data[self::ERROR_LABEL] = 'Stare haslo nieprawidlowe';
            return false;
        }
        $this->newPassword = $this->validate->set($this->request->post()->get('fNewPassword'), 'Nowe haslo')
            ->filterValue()
            ->checkIfEmpty()
            ->validateText(6, 20)
            ->get();
        $this->newPasswordProve = $this->validate->set($this->request->post()->get('fNewPasswordProve'), 'Nowe haslo')
            ->filterValue()
            ->checkIfEmpty()
            ->validateText(6, 20)
            ->comparePasswords($this->newPassword)
            ->get();
        $errors = $this->validate->getErrors();
        if (!empty($errors)) {
            $this->data[self::ERROR_LABEL] = $errors;
            return false;
        }
        return true;
    }

    public function processChangePassword(): bool
    {
        $data = [
          'password' => Password::hash($this->newPassword)
        ];
        return $this->db->update($this->tables->user, $data)->where('id', '=', $this->id)->execute();
    }
}