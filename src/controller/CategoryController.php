<?php


namespace src\controller;


use src\model\CategoryModel;
use src\view\View;

class CategoryController extends CommonController
{
    public function category()
    {
        $data = (new CategoryModel($this->request))->getCategories()->getEntries()->getData();
        (new View($this->request))->data($data)->template('default')->file('category')->render();
    }
}