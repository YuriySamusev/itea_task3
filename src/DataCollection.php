<?php


final class DataCollection
{
    private $docs = [];

    public function add(IList $item)
    {
        $this->docs[] = $item;
    }

    public function clear()
    {
        foreach ($this->docs as $item){
            if($item instanceof IList)
                $item->clear();
        }
        $this->docs = [];
    }

    public function set($key, $val)
    {
        foreach ($this->docs as $item){
            if($item instanceof IList)
                $item->set($key, $val);
        }
    }

    public function __toString()
    {
        $result = '';

        foreach ($this->docs as $item){
            if($item instanceof AList)
                $result .= $item;
        }

        return $result ?: 'Collection is empty' . PHP_EOL;
    }
}