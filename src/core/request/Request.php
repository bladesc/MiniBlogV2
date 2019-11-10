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

    public function query(): object
    {
        $this->dataType = __FUNCTION__;
        return $this;
    }

    public function post(): object
    {
        $this->dataType = __FUNCTION__;
        return $this;
    }

    public function files(): object
    {
        $this->dataType = __FUNCTION__;
        return $this;
    }

    public function cookie(): object
    {
        $this->dataType = __FUNCTION__;
        return $this;
    }

    public function server(): object
    {
        $this->dataType = __FUNCTION__;
        return $this;
    }

    public function all(): array
    {
        return $this->all;
    }

    public function get($key = null)
    {
        if($key !== null) {
            try {
                return $this->{$this->dataType}[$key];
            } catch (\Exception $e) {
                echo "Message. " . $e->getMessage();
            }
        } else {
            return $this->{$this->dataType};
        }
    }

    public function add($key, $value): bool
    {
        if (!$this->has($key)) {
            $this->{$this->dataType}[$key] = $value;
            return true;
        }
        return false;
    }

    public function replace($key, $value): bool
    {
        return $this->{$this->dataType}[$key] = $value;
    }

    public function has($key): bool
    {
        return (isset($this->{$this->dataType}[$key]));
    }

    public function remove($key): bool
    {
        unset($this->{$this->dataType}[$key]);
        return true;
    }

}