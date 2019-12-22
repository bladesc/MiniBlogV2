<?php

namespace src\controller;

use src\core\redirect\Redirect;
use src\model\CommonModel;
use src\model\IndexModel;
use src\view\View;
use src\core\general\Communicate;

class IndexController extends CommonController
{
    public function index()
    {
        $data = (new IndexModel($this->request))->getCategories()->getEntries()->getData();
        (new View($this->request))->data($data)->template('default')->file('index')->render();
    }

    public function logout()
    {
        $data = (new IndexModel($this->request))->logout()->getData();
        if ($data[CommonModel::ACTION_LOGOUT]) {
            $this->session->change(Communicate::C_POSITIVE, 'Wylogowano pomyslnie');
            Redirect::redirectTo('index.php?page=index');
        }
        (new View($this->request))->data($data)->template('default')->file('index')->render();
    }
}