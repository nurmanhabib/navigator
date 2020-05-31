<?php

namespace Nurmanhabib\Navigator\Items;

class NavLink extends NavItem
{
    protected $text;
    protected $url;
    protected $icon;

    public function __construct($text, $url = '#', $icon = null)
    {
        $this->text = $text;
        $this->url = $url;
        $this->icon = $icon;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    public function getIcon()
    {
        return $this->icon;
    }

    public function getType()
    {
        return 'link';
    }
}
