<?php

namespace Nurmanhabib\Navigator\Modifiers;

use Nurmanhabib\Navigator\Items\Nav;

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

    public function add(Nav $nav)
    {
        return $this->nav->add($nav);
    }

    public function getType()
    {
        return $this->nav->getType();
    }

    public function toArray()
    {
        return [
            'text' => $this->getText(),
            'url' => $this->getUrl(),
            'icon' => $this->getIcon(),
            'type' => $this->getType(),
            'is_active' => $this->isActive(),
            'is_visible' => $this->isVisible(),
            'has_child' => $this->hasChild(),
            'child' => $this->getChild()->toArray(),
        ];
    }
}
