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
            $this->session->change(Communicate::C_POSITIVE, $this->translations->pl['addedSuc']);
            Redirect::redirectTo('index.php?pageadmin=account');
        }
        (new View($this->request))->admin()->data($data)->template('default')->file('accountcreate')->render();
    }

    public function prepareDelete()
    {
        $data = (new AccountModel($this->request))->getAccount()->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('accountdelete')->render();
    }

    public function delete()
    {
        $model = (new AccountModel($this->request));
        $data = $model->getAccount()->deleteItem()->getData();
        if ($data[CommonModel::ACTION_DELETED]) {
            $this->session->change(Communicate::C_POSITIVE, $this->translations->pl['deletedSuc']);
            Redirect::redirectTo('index.php?pageadmin=account');
        }
        (new View($this->request))->admin()->data($data)->template('default')->file('accountdelete')->render();
    }

    public function prepareUpdate()
    {
        $data = (new AccountModel($this->request))->getAccount()->getRoles()->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('accountupdate')->render();
    }

    public function update()
    {
        $model = (new AccountModel($this->request));
        $data = $model->setActionType(AccountModel::ACTION_TYPE_UPDATE)->updateItem()->getAccount()->getRoles()->getData();
        if ($data[CommonModel::ACTION_UPDATED]) {
            $this->session->change(Communicate::C_POSITIVE, $this->translations->pl['changedSuc']);
            Redirect::redirectTo('index.php?pageadmin=account');
        }
        (new View($this->request))->admin()->data($data)->template('default')->file('accountupdate')->render();
    }
}