<?php


namespace installation\src\controller;


use installation\src\installation\Install;
use installation\src\model\DatabaseModel;
use src\config\Config;
use src\controller\CommonController;
use src\core\redirect\Redirect;
use src\view\View;

class DatabaseController extends CommonController
{
    public function database()
    {
        $data = (new DatabaseModel($this->request))->getData();
        (new View($this->request))->install()->data($data)->template('default')->file('database')->render();
    }

    public function installation()
    {
        if ($this->request->post()->has('dbcheck')) {
            $model = (new DatabaseModel($this->request, false));
            $data = $model->getFormParams()->getConnectionInfo()->getData();
            (new View($this->request))->install()->data($data)->template('default')->file('database')->render();
        } else {
            $model = (new DatabaseModel($this->request, false));
            $data = $model->getFormParams()->install()->getData();
            if ($data['installation']) {
                Redirect::redirectTo('index.php?install_page=blog');
            }
            (new View($this->request))->install()->data($data)->template('default')->file('database')->render();
        }
    }
}