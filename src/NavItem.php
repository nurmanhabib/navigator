<?php

namespace Nurmanhabib\Navigator;

class NavItem
{
    public $text;
    public $url;
    public $child;
    public $icon;

    protected $originalURL;
    protected $active;
    protected $visible = true;

    public function __construct($text, $url, $icon = null, $active = false)
    {
        $this->text = $text;
        $this->url = $this->originalURL = $url;
        $this->child = new NavCollection;

        $this->icon = $icon;
        $this->active = $active;
    }

    public function setPrefix($prefix)
    {
        if (!str_contains($this->url, '://')) {
            $this->url = ($prefix ? rtrim($prefix, '/') : '') . ltrim($this->originalURL, '/');
        }
    }

    public function hasChild()
    {
        return !$this->child->isEmpty();
    }

    public function setChild(NavCollection $child)
    {
        $this->child = $child;
    }

    public function setActive($active = true)
    {
        $this->active = $active;
    }

    public function setVisible($visible = true)
    {
        $this->visible = $visible;
    }

    public function isActive()
    {
        return (bool) $this->active;
    }

    public function isVisible()
    {
        return (bool) $this->visible;
    }

    public function toArray()
    {
        return [
            'text' => $this->text,
            'url' => $this->url,
            'icon' => $this->icon,
            'active' => $this->isActive(),
            'visible' => $this->isVisible(),
            'child' => $this->child->toArray(),
        ];
    }

    public function __toString()
    {
        return json_encode($this->toArray());
    }

}
