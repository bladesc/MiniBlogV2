<?php


namespace admin\src\controller;

use admin\src\model\CategoryModel;
use src\controller\CommonController;
use src\core\general\Communicate;
use src\core\redirect\Redirect;
use src\session\Session;
use src\view\View;

class CategoryController extends CommonController
{
    public function category()
    {
        (new View($this->request))->admin()->template('default')->file('categories')->render();
    }

    public function add()
    {
        (new View($this->request))->admin()->template('default')->file('categoriesadd')->render();
    }

    public function create()
    {
        $model = (new CategoryModel($this->request));
        $data = $model->addCategory()->getData();
        if ($data['catInserted']) {
            Session::change(Communicate::C_POSITIVE, 'Dodano pomyslnie');
            Redirect::redirectTo('index.php?pageadmin=category');
        }
        (new View($this->request))->admin()->data($data)->template('default')->file('categoriesadd')->render();
    }

    public function delete()
    {

    }

    public function update()
    {

    }
}