<?php

namespace src\core\request;

class Request
{
    protected $query;
    protected $post;
    protected $files;
    protected $cookie;
    protected $server;
    protected $all;

    protected $dataType;

    public function __construct()
    {
        $this->query = $_GET;
        $this->post = $_POST;
        $this->files = $_FILES;
        $this->cookie = $_COOKIE;
        $this->server = $_SERVER;
        $this->all = [
            'query' => $this->query,
            'post' => $this->post,
            'files' => $this->files,
            'cookie' => $this->cookie,
            'server' => $this->server
        ];
    }

    public function query()
    {
        $this->dataType = __FUNCTION__;
        return $this;
    }

    public function post()
    {
        $this->dataType = __FUNCTION__;
        return $this;
    }

    public function files()
    {
        $this->dataType = __FUNCTION__;
        return $this;
    }

    public function cookie()
    {
        $this->dataType = __FUNCTION__;
        return $this;
    }

    public function server()
    {
        $this->dataType = __FUNCTION__;
        return $this;
    }

    public function all()
    {
        return $this->all;
    }

    public function get($key)
    {
        try {
            return $this->{$this->dataType}[$key];
        } catch (\Exception $e) {
            echo "Message. " . $e->getMessage();
        }
    }

    public function add($key, $value)
    {
        if (!$this->has($key)) {
            $this->{$this->dataType}[$key] = $value;
            return true;
        }
        return false;
    }

    public function replace($key, $value)
    {
        $this->{$this->dataType}[$key] = $value;
        return true;
    }

    public function has($key)
    {
        return (isset($this->{$this->dataType}[$key]));
    }

    public function remove($key)
    {
        unset($this->{$this->dataType}[$key]);
    }

}