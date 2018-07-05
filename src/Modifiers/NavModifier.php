<?php

namespace Nurmanhabib\Navigator\Modifiers;

use Nurmanhabib\Navigator\Items\Nav;
use Nurmanhabib\Navigator\NavCollection;

abstract class NavModifier implements Nav
{
    /**
     * @var Nav
     */
    protected $nav;

    /**
     * NavModifier constructor.
     *
     * @param Nav $nav
     */
    public function __construct(Nav $nav)
    {
        $this->nav = $nav;
    }

    public function getText()
    {
        return $this->nav->getText();
    }

    public function getUrl()
    {
        return $this->nav->getUrl();
    }

    public function getIcon()
    {
        return $this->nav->getIcon();
    }

    public function isActive()
    {
        return $this->nav->isActive();
    }

    public function isVisible()
    {
        return $this->nav->isVisible();
    }

    public function hasChild()
    {
        return $this->nav->hasChild();
    }

    public function getChild()
    {
        return $this->nav->getChild();
    }

    public function setChild(NavCollection $child)
    {
        return $this->nav->setChild($child);
    }

    public function add(Nav $nav)
    {
        return $this->nav->add($nav);
    }

    public function getType()
    {
        return $this->nav->getType();
    }

    public function getOriginalNav()
    {
        return $this->nav;
    }

    public function setData(array $data)
    {
        return $this->nav->setData($data);
    }

    public function hasData($key)
    {
        return $this->nav->hasData($key);
    }

    public function getData($key = null, $default = null)
    {
        return $this->nav->getData($key, $default);
    }

    public function toArray()
    {
        return $this->nav->toArray();
    }
}
