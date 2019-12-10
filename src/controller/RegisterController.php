<?php


namespace src\controller;


use admin\src\model\EntryModel;
use src\core\general\Communicate;
use src\core\redirect\Redirect;
use src\model\RegisterModel;
use src\view\View;

class RegisterController extends CommonController
{
    public function register()
    {
        $data = (new RegisterModel($this->request))->getData();
        (new View($this->request))->data($data)->template('default')->file('register')->render();
    }

    public function create()
    {
        $model = (new RegisterModel($this->request));
        $data = $model->addUser()->getData();
        if ($data['userInserted']) {
            $this->session->change(Communicate::C_POSITIVE, 'Dodano pomyslnie');
            Redirect::redirectTo('index.php?page=register');
        }
        (new View($this->request))->data($data)->template('default')->file('register')->render();
    }

}