<?php
require_once __DIR__ . "/IList.php";

abstract class AList implements IList
{
    protected $list;

    protected function keyValidate(&$key)
    {
        return is_string($key) || is_int($key);
    }

    public function __toString()
    {
        return sprintf("[%s] -> %s", static::class, (string) print_r($this->list, true));
    }
}