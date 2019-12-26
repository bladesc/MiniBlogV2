<?php


namespace admin\src\controller;


use admin\src\model\CategoryModel;
use admin\src\model\GalleryModel;
use src\controller\CommonController;
use src\core\general\Communicate;
use src\core\permission\Permission;
use src\core\redirect\Redirect;
use src\model\CommonModel;
use src\view\View;

class GalleryController extends CommonController
{
    public function gallery()
    {
        (new Permission())->setRole(1)->checkPermission();
        $data = (new GalleryModel($this->request))->getGalleries()->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('gallery')->render();
    }

    public function prepareCreate()
    {
        (new Permission())->setRole(1)->checkPermission();
        $data = (new GalleryModel($this->request))->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('gallerycreate')->render();
    }

    public function create()
    {
        (new Permission())->setRole(1)->checkPermission();
        $model = (new GalleryModel($this->request));
        $data = $model->insertItem()->getData();
        if ($data[CommonModel::ACTION_INSERTED]) {
            $this->session->change(Communicate::C_POSITIVE, $this->translations->pl['addedSuc']);
            Redirect::redirectTo('index.php?pageadmin=gallery');
        }
        (new View($this->request))->admin()->data($data)->template('default')->file('gallerycreate')->render();
    }

    public function prepareDelete()
    {
        (new Permission())->setRole(1)->checkPermission();
        $data = (new GalleryModel($this->request))->getGallery()->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('gallerydelete')->render();
    }

    public function delete()
    {
        (new Permission())->setRole(1)->checkPermission();
        $model = (new GalleryModel($this->request));
        $data = $model->getGallery()->deleteItem()->getData();
        if ($data[CommonModel::ACTION_DELETED]) {
            $this->session->change(Communicate::C_POSITIVE, $this->translations->pl['deletedSuc']);
            Redirect::redirectTo('index.php?pageadmin=gallery');
        }
        (new View($this->request))->admin()->data($data)->template('default')->file('gallerydelete')->render();
    }

    public function prepareUpdate()
    {
        (new Permission())->setRole(1)->checkPermission();
        $data = (new GalleryModel($this->request))->getGallery()->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('galleryupdate')->render();
    }

    public function update()
    {
        (new Permission())->setRole(1)->checkPermission();
        $model = (new GalleryModel($this->request));
        $data = $model->getGallery()->updateItem()->getData();
        if ($data[CommonModel::ACTION_UPDATED]) {
            $this->session->change(Communicate::C_POSITIVE, $this->translations->pl['changedSuc']);
            Redirect::redirectTo('index.php?pageadmin=gallery');
        }
        (new View($this->request))->admin()->data($data)->template('default')->file('galleryupdate')->render();
    }

    public function show()
    {
        (new Permission())->setRole(1)->checkPermission();
        $data = (new GalleryModel($this->request))->getGallery()->getImages()->getData();
        (new View($this->request))->admin()->data($data)->template('default')->file('galleryshow')->render();
    }
}