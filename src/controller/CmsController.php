<?php


namespace src\controller;


use src\model\CmsModel;
use src\model\NotfoundModel;
use src\view\View;

class CmsController extends CommonController
{
    public function __call($method, $args) {
        $pagesList = (new CmsModel($this->request))->getCmsPages();
        if (!in_array($method, $pagesList)) {
            $this->nonExistedPage();
        } else {
            $this->existedPage($method);
        }
    }

    protected function nonExistedPage()
    {
        $data = (new NotfoundModel($this->request))->getData();
        (new View($this->request))->data($data)->template('default')->file('notfound')->render();
    }

    protected function existedPage(string $page)
    {
        $data = (new CmsModel($this->request))->getPage($page)->getCategories()->getData();
        (new View($this->request))->data($data)->template('default')->file('page')->render();
    }
}