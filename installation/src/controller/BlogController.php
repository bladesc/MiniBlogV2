<?php


namespace installation\src\controller;


use installation\src\model\BlogModel;
use installation\src\model\DatabaseModel;
use src\controller\CommonController;
use src\core\redirect\Redirect;
use src\view\View;

class BlogController extends CommonController
{
    public function blog()
    {
        (new View($this->request))->install()->data()->template('installation')->file('blog')->render();
    }

    public function addUser()
    {   $model = (new BlogModel($this->request));
        $data = $model->addUser()->getData();
        if ($data['userInserted']) {
            Redirect::redirectTo('index.php?install_page=end');
        }
        (new View($this->request))->install()->data($data)->template('installation')->file('blog')->render();
    }
}