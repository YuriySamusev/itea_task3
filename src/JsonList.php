<?php
require_once __DIR__ . "/AList.php";

class JsonList extends AList
{
    const FILE_PART = __DIR__ . '/db/data.json';

    private function updateSource()
    {
        file_put_contents(self::FILE_PART, json_encode($this->list));
    }

    public function __construct(array $params = [])
    {
        $data = file_get_contents(self::FILE_PART);
        $this->list = array_merge(($data !== false? json_decode($data, true) : []), $params);
    }

    public function clear()
    {
        $this->list = [];
        self::updateSource();
    }

    public function set($key, $value)
    {
        if(!$this->keyValidate($key)) return;

        $this->list[$key] = $value;
        self::updateSource();
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
        if(!$this->keyValidate($key)) return;

        unset ($this->list[$key]);
        self::updateSource();
    }
}