<?php


namespace src\controller;


use src\model\SearchModel;
use src\view\View;

class SearchController extends CommonController
{
    public function search()
    {
        $data = (new SearchModel($this->request))->getCategories()->getEntries()->getData();
        (new View($this->request))->data($data)->template('default')->file('search')->render();
    }
}