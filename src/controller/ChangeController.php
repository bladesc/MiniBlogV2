<?php


namespace src\controller;


use src\core\general\Communicate;
use src\core\redirect\Redirect;
use src\model\ChangeModel;
use src\view\View;

class ChangeController extends CommonController
{
    public function change()
    {
        $data = (new ChangeModel($this->request))->getData();
        (new View($this->request))->data($data)->template('default')->file('change')->render();
    }

    public function processChange()
    {
        $model = (new ChangeModel($this->request));
        $data = $model->changePassword()->getData();
        if ($data['passwordChanged']) {
            $this->session->change(Communicate::C_POSITIVE, 'Haslo zmienione pomyslnie');
            Redirect::redirectTo('index.php?page=index');
        }
        (new View($this->request))->data($data)->template('default')->file('change')->render();
    }
}