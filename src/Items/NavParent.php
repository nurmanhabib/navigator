<?php

namespace Nurmanhabib\Navigator\Items;

use Nurmanhabib\Navigator\NavCollection;

class NavParent extends NavLink
{
    protected $child;

    public function __construct($text, $url = '#', $icon = null)
    {
        parent::__construct($text, $url, $icon);

        $this->child = new NavCollection;
    }

    public function hasChild()
    {
        return $this->child->isNotEmpty();
    }

    public function getChild()
    {
        return $this->child;
    }

    public function add(Nav $item)
    {
        return $this->child->add($item);
    }
}
