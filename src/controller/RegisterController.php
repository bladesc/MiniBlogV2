<?php


namespace src\controller;


use admin\src\model\EntryModel;
use src\core\general\Communicate;
use src\core\redirect\Redirect;
use src\model\CommonModel;
use src\model\RegisterModel;
use src\view\View;

class RegisterController extends CommonController
{
    public function register()
    {
        $data = (new RegisterModel($this->request))->getCategories()->getData();
        (new View($this->request))->data($data)->template('default')->file('register')->render();
    }

    public function create()
    {
        $model = (new RegisterModel($this->request));
        $data = $model->addUser()->getCategories()->getData();
        if ($data[CommonModel::ACTION_INSERTED]) {
            $this->session->change(Communicate::C_POSITIVE, 'Dodano pomyslnie');
            Redirect::redirectTo('index.php?page=login');
        }
        (new View($this->request))->data($data)->template('default')->file('register')->render();
    }

}