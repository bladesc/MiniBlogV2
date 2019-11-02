<?php


namespace src\view;


class View extends BaseView
{
    protected $data = [];

    public function data($data)
    {
        $this->data = $data;
        return $this;
    }

    public function template(string $templateName)
    {
        $this->templateName = $templateName;
        return $this;
    }

    public function file(string $fileName)
    {
        $this->fileName = $fileName;
        return $this;
    }

    public function render()
    {
        include $this->getFilePath();
    }

    public function getFilePath()
    {
        return  __DIR__ . '/../template/' . $this->templateName . '/' . $this->fileName . '.php';
    }

}