<?php


namespace admin\src\controller;


use admin\src\model\AccountModel;
use src\controller\CommonController;
use src\core\general\Communicate;
use src\core\redirect\Redirect;
use src\model\CommonModel;
use src\view\View;

class AccountController extends CommonController
{
    public function account()
    {
        $model = (new AccountModel($this->request));
        $data = $model->getAccounts()->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('account')->render();
    }

    public function prepareCreate()
    {
        $model = (new AccountModel($this->request));
        $data = $model->getRoles()->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('accountcreate')->render();
    }

    public function create()
    {
        $model = (new AccountModel($this->request));
        $data = $model->insertItem()->getRoles()->getData();
        if ($data[CommonModel::ACTION_INSERTED]) {
            $this->session->change(Communicate::C_POSITIVE, 'Dodano pomyslnie');
            Redirect::redirectTo('index.php?pageadmin=account');
        }
        (new View($this->request))->admin()->data($data)->template('default')->file('accountcreate')->render();
    }

    public function prepareDelete()
    {
        $data = (new AccountModel($this->request))->getCategory()->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('accountdelete')->render();
    }

    public function delete()
    {
        $model = (new AccountModel($this->request));
        $data = $model->getCategory()->deleteItem()->getData();
        if ($data[CommonModel::ACTION_DELETED]) {
            $this->session->change(Communicate::C_POSITIVE, 'Usunieto pomyslnie');
            Redirect::redirectTo('index.php?pageadmin=account');
        }
        (new View($this->request))->admin()->data($data)->template('default')->file('accountdelete')->render();
    }

    public function prepareUpdate()
    {
        $data = (new AccountModel($this->request))->getAccount()->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('accountupdate')->render();
    }

    public function update()
    {
        $model = (new AccountModel($this->request));
        $data = $model->getCategory()->updateItem()->getData();
        if ($data[CommonModel::ACTION_UPDATED]) {
            $this->session->change(Communicate::C_POSITIVE, 'Zmienono pomyslnie');
            Redirect::redirectTo('index.php?pageadmin=account');
        }
        (new View($this->request))->admin()->data($data)->template('default')->file('accountupdate')->render();
    }
}