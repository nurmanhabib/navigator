<?php

namespace Nurmanhabib\Navigator\Items;

trait NavDataTrait
{
    protected $data = [];

    public function getData($key = null, $default = null)
    {
        if (!$key) {
            return $this->data;
        }

        return $this->hasData($key) ? $this->data[$key] : $default;
    }

    public function setData(array $data)
    {
        $this->data = array_merge($this->data, $data);

        return $this;
    }

    public function hasData($key)
    {
        return array_key_exists($key, $this->data);
    }
}
