<?php namespace Nurmanhabib\Navigator;

use Closure;

class NavItem {

    use AttributeTrait;

    protected $collection;
    protected $attributes;

    public function __construct($attributes = [])
    {
        $this->initialize($attributes);
    }

    public function initialize($attributes = [])
    {
        $this->attributes = [
            'text'  => 'My Link',
            'url'   => '#',
            'icon'  => 'dashboard',
        ];

        $this->attributes   = array_merge($this->attributes, $attributes);
        $this->collection   = new NavCollection;
    }

    public function instance($attributes)
    {
        return new NavItem($attributes);
    }

    public function set($text, $url = '#', $icon = 'dashboard')
    {
        if (is_array($text))
            $attributes = $text;
        else
            $attributes = [
                'text'  => $text,
                'url'   => $url,
                'icon'  => $icon,
            ];

        return $this->initialize($attributes);
    }

    public function iconFa($class = '')
    {
        $class = $class ? ' ' . trim($class) : '';

        return '<i class="fa fa-' . $this->attributes['icon'] . $class . '"></i>';
    }

    public function isActive()
    {
        return $this->attr('url') == $this->collection->active;
    }

    public function child(Closure $callback)
    {
        $this->collection->template .= '.child';

        $this->attributes['child'] = $callback($this->collection);

        return $this->collection;
    }

    public function hasChild()
    {
        return array_key_exists('child', $this->attributes);
    }

    public function setCollection(NavCollection $collection)
    {
        $this->collection = $collection;
    }

    public function getCollection()
    {
        return $this->collection;
    }

    public function __set($key, $value)
    {
        $this->attributes[$key] = $value;
    }

    public function __get($key)
    {
        return array_get($this->attributes, $key);
    }

    public function toArray()
    {
        $array = $this->attributes;

        if (array_key_exists('child', $array))
            $array['child'] = $this->attributes['child']->toArray();

        return $array;
    }

    public function __toString()
    {
        return json_encode($this->toArray());
    }

}