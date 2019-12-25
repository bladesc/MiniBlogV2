<?php


namespace admin\src\controller;

use admin\src\model\CategoryModel;
use src\controller\CommonController;
use src\core\general\Communicate;
use src\core\redirect\Redirect;
use src\model\BaseModel;
use src\model\CommonModel;
use src\session\Session;
use src\view\View;

class CategoryController extends CommonController
{
    public function category()
    {
        $data = (new CategoryModel($this->request))->getCategories()->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('categories')->render();
    }

    public function prepareCreate()
    {
        $data = (new CategoryModel($this->request))->getCategories()->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('categoriescreate')->render();
    }

    public function create()
    {
        $model = (new CategoryModel($this->request));
        $data = $model->insertItem()->getData();
        if ($data[CommonModel::ACTION_INSERTED]) {
            $this->session->change(Communicate::C_POSITIVE, 'Dodano pomyslnie');
            Redirect::redirectTo('index.php?pageadmin=category');
        }
        (new View($this->request))->admin()->data($data)->template('default')->file('categoriescreate')->render();
    }

    public function prepareDelete()
    {
        $data = (new CategoryModel($this->request))->getCategory()->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('categoriesdelete')->render();
    }

    public function delete()
    {
        $model = (new CategoryModel($this->request));
        $data = $model->getCategory()->deleteItem()->getData();
        if ($data[CommonModel::ACTION_DELETED]) {
            $this->session->change(Communicate::C_POSITIVE, 'Usunieto pomyslnie');
            Redirect::redirectTo('index.php?pageadmin=category');
        }
        (new View($this->request))->admin()->data($data)->template('default')->file('categoriesdelete')->render();
    }

    public function prepareUpdate()
    {
        $data = (new CategoryModel($this->request))->getCategory()->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('categoriesupdate')->render();
    }

    public function update()
    {
        $model = (new CategoryModel($this->request));
        $data = $model->getCategory()->updateItem()->getData();
        if ($data[CommonModel::ACTION_UPDATED]) {
            $this->session->change(Communicate::C_POSITIVE, 'Zmienono pomyslnie');
            Redirect::redirectTo('index.php?pageadmin=category');
        }
        (new View($this->request))->admin()->data($data)->template('default')->file('categoriesupdate')->render();
    }

}