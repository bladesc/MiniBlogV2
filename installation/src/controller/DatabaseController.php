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
        (new View($this->request))->install()->data($data)->template('installation')->file('database')->render();
    }

    public function checkConnection()
    {
        if ($this->request->post()->has('dbcheck')) {
            $dbModel = (new DatabaseModel($this->request));
            $data = $dbModel->getFormParams()->getConnectionInfo()->getData();
            (new View($this->request))->install()->data($data)->template('installation')->file('database')->render();
        } else {
            $dbModel = (new DatabaseModel($this->request));
            $data = $dbModel->getFormParams()->install(new Install())->getData();
            $data['installation'] = true;
            if ($data['installation']) {
                Redirect::redirectTo(($this->request->additional()->get('requestUri')) . '&action=blog');
            }
            (new View($this->request))->install()->data($data)->template('installation')->file('database')->render();
        }
    }
}