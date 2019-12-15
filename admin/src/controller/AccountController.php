<?php


namespace admin\src\controller;


use admin\src\model\AccountModel;
use src\controller\CommonController;
use src\view\View;

class AccountController extends CommonController
{
    public function account()
    {
        $model = (new AccountModel($this->request));
        $data = $model->getAccounts()->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('account')->render();
    }
}