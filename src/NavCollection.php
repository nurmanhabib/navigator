<?php namespace Nurmanhabib\Navigator;

use Illuminate\Support\Facades\Config;

class NavCollection {

    use AttributeTrait;

    protected $attributes;
    protected $views;

    public function __construct($items = [], $active = '')
    {
        $this->attributes = [
            'items'    => $items,
            'active'   => $active,
            'template' => 'navigator::template.arjuna',
        ];

        $this->views = [
            'index'         => 'index',
            'item'          => 'item',
            'item_active'   => 'item_active',
            'item_disabled' => 'item_disabled',
            'child'         => 'child',
            'child_active'  => 'child_active',
        ];
    }

    public function instance($items = [], $disabled = [])
    {
        return new NavCollection($items, $disabled);
    }

    public function instanceCopy()
    {
        $instance = $this->instance();
        $instance->attributes = $this->attributes;
        $instance->attributes['items'] = [];

        return $instance;
    }

    public function set($text, $url = '#', $icon = 'dashboard')
    {
        $item = new NavItem;
        $item->set($text, $url, $icon);

        return $this->addItem($item);
    }

    public function addItem(NavItem $item = null)
    {
        $collection = $this->instanceCopy();

        $item = $item ?: new NavItem;
        $item->setCollection($collection);

        $this->attributes['items'][] = $item;

        return $item;
    }

    public function setTemplate($name)
    {
        $this->attr('template', $name);

        return $this;
    }

    public function setToParentTemplate()
    {
        $this->attr('template', $this->getParentTemplate());

        return $this;
    }

    public function getParentTemplate()
    {
        $template   = $this->attr('template');
        $six_last   = substr($template, -6);

        if ($six_last == '.child')
            return substr($template, 0, -6);
            return false;
    }

    public function setActive($url)
    {
        $this->attributes['active'] = $url;

        foreach ($this->attributes['items'] as $item) {            
            if ($item->hasChild())
                $item->child->setActive($url);
            
            $item->setCollection($this->instanceCopy());
        }

        return $this;
    }

    public function isActive()
    {
        $active = $this->attr('active');

        foreach ($this->attributes['items'] as $item) {
            if ($item->hasChild() && $item->child->isActive())
                    return true;
            
            elseif ($item->isActive())
                return true;
        }

        return false;
    }

    public function render()
    {
        $rendering = new NavigatorRendering($this);

        return $rendering->render();
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
        $array          = $this->attributes;
        $array['items'] = [];

        foreach ($this->attributes['items'] as $item)
            $array['items'][] = $item->toArray();

        return $array;
    }

    public function __toString()
    {
        return $this->render();
    }

}