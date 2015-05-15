<?php namespace Nurmanhabib\Navigator;

use Illuminate\Support\Facades\Config;

use Closure;

class NavCollection {

    use AttributeTrait;

    protected $attributes;
    protected $views;

    protected $pointer  = null;
    protected $parent   = null;
    protected $child    = null;

    public function __construct($items = [], $active = '')
    {
        $this->attributes = [
            'items'    => $items,
            'active'   => $active,
            'template' => 'navigator::template.sbadmin2',
        ];

        $this->views = [
            'index'         => 'index',
            'item'          => 'item',
            'item_active'   => 'item_active',
            'item_disabled' => 'item_disabled',
            'child'         => 'child',
            'child_active'  => 'child_active',
        ];

        $this->pointer = $this;
    }

    public function set($text, $url, $icon)
    {
        if ($this->pointer->child) {
            $this->pointer->child->set($text, $url, $icon);
        } else {
            $this->pointer->attributes['items'][] = new NavItem($text, $url, $icon);
        }

        return $this;
    }

    public function child(Closure $callback)
    {
        $this->prepareChild();

        call_user_func($callback, $this);

        $this->backToParent();
    }

    public function prepareChild()
    {
        $this->pointer->child           = new NavCollection;
        $this->pointer->child->template = $this->pointer->template . '.child';
        $this->pointer->child->parent   = $this->pointer;

        $item           = end($this->pointer->attributes['items']);
        $item->child    = $this->pointer->child;

        $this->pointer  = $this->pointer->child;
    }

    public function backToParent()
    {
        $this->pointer          = $this->pointer->parent;
        $this->pointer->child   = null;
    }

    public function setTemplate($name)
    {
        $this->pointer->template = $name;

        return $this;
    }

    public function setActive($url)
    {
        $this->active = $url;

        foreach ($this->items as $item) {            
            if ($item->hasChild())
                $item->child->setActive($url);            
        }

        return $this;
    }

    public function isActive()
    {
        $active = $this->active;

        foreach ($this->items as $item) {
            if ($item->hasChild() && $item->child->isActive())
                    return true;
            
            elseif ($item->isActive($active))
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
