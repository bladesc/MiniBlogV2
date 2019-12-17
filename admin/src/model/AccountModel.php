<?php


namespace admin\src\model;


use src\core\general\Password;
use src\core\general\Role;
use src\core\helper\Helper;
use src\model\CommonModel;

class AccountModel extends CommonModel
{
    protected $data = [];
    protected $nick;
    protected $email;
    protected $password;
    protected $passwordProve;
    protected $role;
    protected $status;
    protected $firstName;
    protected $surName;
    protected $birthday;

    public function getAccounts()
    {
        $this->data['accounts'] = $this->db->select([
            $this->tables->user . '.id as user_id',
            $this->tables->user . '.nick as user_nick',
            $this->tables->user . '.email as user_email',
            $this->tables->user . '.status as user_status',
            $this->tables->user . '.created_at as user_created_at',
            $this->tables->user . '.updated_at as user_updated_at',
            $this->tables->user_details . '.id as user_details_id',
            $this->tables->user_details . '.firstname as user_details_firstname',
            $this->tables->user_details . '.surname as user_details_surname',
            $this->tables->user_details . '.birthday as user_details_birthday',
            $this->tables->role . '.id as user_role_id',
            $this->tables->role . '.name as user_role_name',
        ])
            ->from($this->tables->user)
            ->leftJoin($this->tables->user, 'id', $this->tables->user_details, 'user_id')
            ->leftJoin($this->tables->user, 'id', $this->tables->user_remind, 'user_id')
            ->leftJoin($this->tables->user, 'role_id', $this->tables->role, 'id')
            ->getAll();
        return $this;
    }

    public function getRoles()
    {
        $this->data['roles'] = $this->db->select('*')
            ->from($this->tables->role)
            ->getAll();
        return $this;
    }

    public function verifyInsertData(): bool
    {
        $this->nick = $this->validate->set($this->request->post()->get('fNick'), 'Nick')
            ->filterValue()
            ->checkIfEmpty()
            ->validateText(4, 20)
            ->get();
        $this->email = $this->validate->set($this->request->post()->get('fEmail'), 'Email')
            ->filterValue()
            ->checkIfEmpty()
            ->validateText(4, 50)
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
        $this->status = $this->validate->set($this->request->post()->get('fStatus'), 'Status')
            ->filterValue()
            ->checkIfNumeric()
            ->get();

        $this->role = $this->validate->set((int)$this->request->post()->get('fRole'), 'Role')
            ->filterValue()
            ->checkIfEmpty()
            ->checkIfNumeric()
            ->get();

        $this->firstName = $this->validate->set($this->request->post()->get('fFirstName'), 'fFirstName')
            ->filterValue()
            ->get();
        $this->surName = $this->validate->set($this->request->post()->get('fSurName'), 'fSurName')
            ->filterValue()
            ->get();
        $this->birthday = $this->validate->set($this->request->post()->get('fBirthDay'), 'fBirthDay')
            ->filterValue()
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


    public function insertItem()
    {
        $this->data[self::ACTION_INSERTED] = false;
        if ($this->verifyInsertData()) {
            if ($this->insert()) {
                $this->data[self::ACTION_INSERTED] = true;
            }
        }
        return $this;
    }

    public function updateItem()
    {
        $this->data[self::ACTION_UPDATED] = false;
        if ($this->verifyInsertData()) {
            if ($this->update()) {
                $this->data[self::ACTION_UPDATED] = true;
            }
        }
        return $this;
    }

    public function deleteItem()
    {
        $this->data[self::ACTION_DELETED] = false;
        if ($this->delete()) {
            $this->data[self::ACTION_DELETED] = true;
        }
        return $this;
    }

    protected function delete(): bool
    {
        $id = $this->validator->filterValue($this->request->post()->get('fId'));

        return $this->db->delete()->from($this->tables->category)->where('id', '=', $id)->execute();
    }


    protected function update(): bool
    {
        $id = $this->validator->filterValue($this->request->post()->get('fId'));
        $this->db->beginTransactions();
        try {
            $data = [
                'nick' => $this->nick,
                'email' => $this->email,
                'password' => Password::hash($this->password),
                'status' => $this->status,
                'role_id' => $this->role,
                'updated_at' => Helper::now(),
            ];
            $this->db->update($this->tables->user, $data)->where('id', '=', $id)->execute();
            $data = [
                'firstname' => $this->firstName,
                'surname' => $this->surName,
                'birthday' => $this->birthday,
            ];
            $this->db->update($this->tables->user_details, $data)->where('user_id', '=', $id)->execute();
            $this->db->commit();
        } catch (\Exception $e) {
            $this->db->rollback();
            return false;
        }
        return true;
    }

    protected function insert(): bool
    {
        $this->db->beginTransactions();
        try {
            $data = [
                'nick' => $this->nick,
                'email' => $this->email,
                'password' => Password::hash($this->password),
                'status' => $this->status,
                'role_id' => $this->role,
                'created_at' => Helper::now(),
                'updated_at' => Helper::now(),
            ];
            $this->db->insert($this->tables->user, $data)->execute();
            $userId = $this->db->getLastInsertId();
            $data = [
                'firstname' => $this->firstName,
                'surname' => $this->surName,
                'birthday' => $this->birthday,
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

    public function getAccount(): object
    {
        $id = $this->validator->filterValue($this->request->query()->get('id'));
        $this->data['accounts'] = $this->db->select([
            $this->tables->user . '.id as user_id',
            $this->tables->user . '.nick as user_nick',
            $this->tables->user . '.email as user_email',
            $this->tables->user . '.status as user_status',
            $this->tables->user . '.created_at as user_created_at',
            $this->tables->user . '.updated_at as user_updated_at',
            $this->tables->user_details . '.id as user_details_id',
            $this->tables->user_details . '.firstname as user_details_firstname',
            $this->tables->user_details . '.surname as user_details_surname',
            $this->tables->user_details . '.birthday as user_details_birthday',
            $this->tables->role . '.id as user_role_id',
            $this->tables->role . '.name as user_role_name',
        ])
            ->from($this->tables->user)
            ->leftJoin($this->tables->user, 'id', $this->tables->user_details, 'user_id')
            ->leftJoin($this->tables->user, 'id', $this->tables->user_remind, 'user_id')
            ->leftJoin($this->tables->user, 'role_id', $this->tables->role, 'id')
            ->where($this->tables->user . '.id', '=', $id)->getOne();
        return $this;
    }
}