<?php
require_once __DIR__ . "/AList.php";

class ArrayList extends AList
{
    public function __construct(array $params = [])
    {
        $this->list = $params;
    }

    public function clear()
    {
        $this->list = [];
    }

    public function set($key, $value)
    {
        if($this->keyValidate($key))
            $this->list[$key] = $value;
    }

    public function get($key, $default = null)
    {
        return $this->has($key)? $this->list[$key] : $default;
    }

    public function has($key): bool
    {
        return $this->keyValidate($key) && isset($this->list[$key]);
    }

    public function remove($key)
    {
        if($this->keyValidate($key))
            unset ($this->list[$key]);
    }
}