<?php


namespace src\model;


class RemindModel extends CommonModel
{
    protected $data;
    protected $email;
    protected $remindId;
    protected $remindLink;

    public function remindPassword()
    {
        $this->data[self::ACTION_REMINDED] = false;
        if ($this->verifyEmailData()) {
            if ($this->processRemindPassword()) {
                $this->data[self::ACTION_REMINDED] = true;
            }
        }
        return $this;
    }

    public function verifyEmailData(): bool
    {
        $this->email = $this->validate->set($this->request->post()->get('fEmail'), 'Email')
            ->filterValue()
            ->checkIfEmpty()
            ->validateText(4, 20)
            ->validateEmail()
            ->get();
        if (!empty($errors)) {
            $this->data['errors'] = $errors;
            return false;
        }
        return true;
    }

    public function processRemindPassword()
    {
        $remindData = $this->remind->setEmail($this->email)->getRemindData();
        $this->remindLink = $remindData['link'];
        $this->remindId = $remindData['id'];
        $this->insertRemindId();
        return ($this->emailer->setTitle('Remind password')
            ->setRecipients($this->email)
            ->setMessage($this->remindLink)
            ->setSender()
            ->send()) ? true : false;
    }

    public function insertRemindId(): bool
    {
        $data = [

        ];
        return $this->db->update($this->tables->remind, $data)->where('user_id', '=', $this->email)->execute();
    }
}