<?php


namespace src\view;


class View extends BaseView
{
    protected $data = [];
    protected $install = false;
    protected $admin = false;

    public function data($data = [])
    {
        $this->data = $data;
        return $this;
    }

    public function install(): object
    {
        $this->install = true;
        return $this;
    }

    public function admin(): object
    {
        $this->admin = true;
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
        $path = '';
        if ($this->install === true) {
            $path = __DIR__ . '/../../installation/src/template/' . $this->templateName . '/' . $this->fileName . '.php';
        } elseif ($this->admin === true) {
            $path = __DIR__ . '/../../admin/src/template/' . $this->templateName . '/' . $this->fileName . '.php';
        } else {
            $path = __DIR__ . '/../template/' . $this->templateName . '/' . $this->fileName . '.php';
        }
        return $path;
    }

}