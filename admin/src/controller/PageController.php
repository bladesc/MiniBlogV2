<?php


namespace admin\src\controller;


use admin\src\model\PageModel;
use src\controller\CommonController;
use src\core\general\Communicate;
use src\core\redirect\Redirect;
use src\model\CommonModel;
use src\view\View;

class PageController extends CommonController
{
    public function page()
    {
        $data = (new PageModel($this->request))->getPages()->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('pages')->render();
    }

    public function prepareCreate()
    {
        $data = (new PageModel($this->request))->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('pagecreate')->render();
    }

    public function create()
    {
        $model = (new PageModel($this->request));
        $data = $model->insertItem()->getData();
        if ($data[CommonModel::ACTION_INSERTED]) {
            $this->session->change(Communicate::C_POSITIVE, 'Dodano pomyslnie');
            Redirect::redirectTo('index.php?pageadmin=page');
        }
        (new View($this->request))->admin()->data($data)->template('default')->file('pagecreate')->render();
    }

    public function prepareUpdate()
    {
        $data = (new PageModel($this->request))->getPage()->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('pageupdate')->render();
    }

    public function update()
    {
        $model = (new PageModel($this->request));
        $data = $model->updateItem()->getPage()->getData();
        if ($data[CommonModel::ACTION_UPDATED]) {
            $this->session->change(Communicate::C_POSITIVE, 'Zmieniono pomyslnie');
            Redirect::redirectTo('index.php?pageadmin=page');
        }
        (new View($this->request))->admin()->data($data)->template('default')->file('pageupdate')->render();
    }

    public function prepareDelete()
    {
        $model = (new PageModel($this->request));
        $data = $model->updateItem()->getPage()->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('pagedelete')->render();
    }

    public function delete()
    {
        $model = (new PageModel($this->request));
        $data = $model->deleteItem()->getData();
        if ($data[CommonModel::ACTION_DELETED]) {
            $this->session->change(Communicate::C_POSITIVE, 'Usunieto pomyslnie');
            Redirect::redirectTo('index.php?pageadmin=page');
        }
        (new View($this->request))->admin()->data($data)->template('default')->file('pagedelete')->render();
    }
}