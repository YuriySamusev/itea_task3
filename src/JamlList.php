<?php
require_once __DIR__ . "/AList.php";

class JamlList extends AList
{
    const FILE_PART = __DIR__ . '/db/data.jml';

    private function updateSource()
    {
        yaml_emit_file(self::FILE_PART, $this->list);
    }

    public function __construct(array $params = [])
    {
        $data = yaml_parse_file(self::FILE_PART);
        $this->list = array_merge(($data !== false? $data : []), $params);
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