<?php namespace Nurmanhabib\Navigator;

use Closure;

class NavItem {

    use AttributeTrait;

    protected $attributes   = [];

    public function __construct($text = null, $url = null, $icon = null)
    {
        $this->set($text, $url, $icon);
    }

    public function set($text = 'My Link', $url = '#', $icon = 'dashboard')
    {
        if (is_array($text)) {
            $this->initialize($attributes);
        } else {
            $this->text   = $text;
            $this->url    = $url;
            $this->icon   = $icon;
        }
    }

    public function setChild(NavCollection $collection = null)
    {
        $this->child = $collection ?: new NavCollection;
    }

    public function initialize($attributes = [])
    {
        $this->attributes = [
            'text'  => 'My Link',
            'url'   => '#',
            'icon'  => 'dashboard',
        ];

        $this->attributes = array_merge($this->attributes, $attributes);
    }

    public function iconFa($class = '')
    {
        $class = $class ? ' ' . trim($class) : '';

        return '<i class="fa fa-' . $this->attributes['icon'] . $class . '"></i>';
    }

    public function isActive($url = '')
    {
        return $this->url == $url;
    }

    public function hasChild()
    {
        return array_key_exists('child', $this->attributes);
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