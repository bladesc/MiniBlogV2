<?php


namespace admin\src\controller;

use admin\src\model\CategoryModel;
use src\controller\CommonController;
use src\core\general\Communicate;
use src\core\permission\Permission;
use src\core\redirect\Redirect;
use src\model\BaseModel;
use src\model\CommonModel;
use src\session\Session;
use src\view\View;

class CategoryController extends CommonController
{
    public function category()
    {
        (new Permission())->setRole(1)->checkPermission();
        $data = (new CategoryModel($this->request))->getCategories()->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('categories')->render();
    }

    public function prepareCreate()
    {
        (new Permission())->setRole(1)->checkPermission();
        $data = (new CategoryModel($this->request))->getCategories()->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('categoriescreate')->render();
    }

    public function create()
    {
        (new Permission())->setRole(1)->checkPermission();
        $model = (new CategoryModel($this->request));
        $data = $model->insertItem()->getData();
        if ($data[CommonModel::ACTION_INSERTED]) {
            $this->session->change(Communicate::C_POSITIVE, $this->translations->pl['addedSuc']);
            Redirect::redirectTo('index.php?pageadmin=category');
        }
        (new View($this->request))->admin()->data($data)->template('default')->file('categoriescreate')->render();
    }

    public function prepareDelete()
    {
        (new Permission())->setRole(1)->checkPermission();
        $data = (new CategoryModel($this->request))->getCategory()->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('categoriesdelete')->render();
    }

    public function delete()
    {
        (new Permission())->setRole(1)->checkPermission();
        $model = (new CategoryModel($this->request));
        $data = $model->getCategory()->deleteItem()->getData();
        if ($data[CommonModel::ACTION_DELETED]) {
            $this->session->change(Communicate::C_POSITIVE, $this->translations->pl['deletedSuc']);
            Redirect::redirectTo('index.php?pageadmin=category');
        }
        (new View($this->request))->admin()->data($data)->template('default')->file('categoriesdelete')->render();
    }

    public function prepareUpdate()
    {
        (new Permission())->setRole(1)->checkPermission();
        $data = (new CategoryModel($this->request))->getCategory()->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('categoriesupdate')->render();
    }

    public function update()
    {
        (new Permission())->setRole(1)->checkPermission();
        $model = (new CategoryModel($this->request));
        $data = $model->getCategory()->updateItem()->getData();
        if ($data[CommonModel::ACTION_UPDATED]) {
            $this->session->change(Communicate::C_POSITIVE, $this->translations->pl['changedSuc']);
            Redirect::redirectTo('index.php?pageadmin=category');
        }
        (new View($this->request))->admin()->data($data)->template('default')->file('categoriesupdate')->render();
    }

}