<?php namespace Nurmanhabib\Navigator;

trait AttributeTrait {

    public function attr($key, $value = null)
    {
        if (is_null($value))
            return $this->getAttr($key);
        else
            $this->setAttr($key, $value);
    }

    public function setAttr($key, $value)
    {
        $this->attributes[$key] = $value;
    }

    public function getAttr($key)
    {
        return array_get($this->attributes, $key);
    }

}