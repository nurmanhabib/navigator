<?php

namespace Nurmanhabib\Navigator\Activators;

use Nurmanhabib\Navigator\Items\Nav;
use Nurmanhabib\Navigator\Modifiers\NavActive;
use Nurmanhabib\Navigator\NavCollection;

abstract class NavActivator
{
    abstract public function isActive(Nav $nav);

    /**
     * @param NavCollection $menu
     * @return NavCollection
     */
    public function apply(NavCollection $menu)
    {
        return $menu->map(function (Nav $nav) {
            return $this->checkActive($nav) ? $this->makeActive($nav) : $nav;
        });
    }

    protected function checkActive(Nav $nav)
    {
        if ($nav->hasChild()) {
            return $this->hasActive($nav->getChild());
        }

        return $this->isActive($nav);
    }

    public function hasActive(NavCollection $menu)
    {
        return false !== $menu->getItems()->search(function (Nav $nav) {
            return $this->checkActive($nav);
        });
    }

    public function makeActive(Nav $nav)
    {
        return new NavActive($nav);
    }
}
