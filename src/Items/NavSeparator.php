<?php

namespace Nurmanhabib\Navigator\Items;

use Nurmanhabib\Navigator\Exceptions\NavChildException;
use Nurmanhabib\Navigator\NavCollection;

class NavSeparator implements Nav
{
    use NavDataTrait;

    public function getText()
    {
        return '';
    }

    public function getUrl()
    {
        return '';
    }

    public function getIcon()
    {
        return '';
    }

    public function isActive()
    {
        return false;
    }

    public function isVisible()
    {
        return true;
    }

    public function hasChild()
    {
        return false;
    }

    public function getChild()
    {
        return new NavCollection;
    }

    public function setChild(NavCollection $child)
    {
        throw new NavChildException($this);
    }

    public function add(Nav $nav)
    {
        throw new NavChildException($this);
    }

    public function getType()
    {
        return 'separator';
    }

    public function toArray()
    {
        return [
            'type' => $this->getType(),
        ];
    }
}
