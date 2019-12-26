<?php


namespace admin\src\controller;


use admin\src\model\PageModel;
use src\controller\CommonController;
use src\core\general\Communicate;
use src\core\permission\Permission;
use src\core\redirect\Redirect;
use src\model\CommonModel;
use src\view\View;

class PageController extends CommonController
{
    public function page()
    {
        (new Permission())->setRole(1)->checkPermission();
        $data = (new PageModel($this->request))->getPages()->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('pages')->render();
    }

    public function prepareCreate()
    {
        (new Permission())->setRole(1)->checkPermission();
        $data = (new PageModel($this->request))->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('pagecreate')->render();
    }

    public function create()
    {
        (new Permission())->setRole(1)->checkPermission();
        $model = (new PageModel($this->request));
        $data = $model->insertItem()->getData();
        if ($data[CommonModel::ACTION_INSERTED]) {
            $this->session->change(Communicate::C_POSITIVE, $this->translations->pl['addedSuc']);
            Redirect::redirectTo('index.php?pageadmin=page');
        }
        (new View($this->request))->admin()->data($data)->template('default')->file('pagecreate')->render();
    }

    public function prepareUpdate()
    {
        (new Permission())->setRole(1)->checkPermission();
        $data = (new PageModel($this->request))->getPage()->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('pageupdate')->render();
    }

    public function update()
    {
        (new Permission())->setRole(1)->checkPermission();
        $model = (new PageModel($this->request));
        $data = $model->updateItem()->getPage()->getData();
        if ($data[CommonModel::ACTION_UPDATED]) {
            $this->session->change(Communicate::C_POSITIVE, $this->translations->pl['changedSuc']);
            Redirect::redirectTo('index.php?pageadmin=page');
        }
        (new View($this->request))->admin()->data($data)->template('default')->file('pageupdate')->render();
    }

    public function prepareDelete()
    {
        (new Permission())->setRole(1)->checkPermission();
        $model = (new PageModel($this->request));
        $data = $model->getPage()->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('pagedelete')->render();
    }

    public function delete()
    {
        (new Permission())->setRole(1)->checkPermission();
        $model = (new PageModel($this->request));
        $data = $model->deleteItem()->getData();
        if ($data[CommonModel::ACTION_DELETED]) {
            $this->session->change(Communicate::C_POSITIVE, $this->translations->pl['deletedSuc']);
            Redirect::redirectTo('index.php?pageadmin=page');
        }
        (new View($this->request))->admin()->data($data)->template('default')->file('pagedelete')->render();
    }
}