<?php

namespace Nurmanhabib\Navigator\Activators;

use Nurmanhabib\Navigator\Items\Nav;
use Nurmanhabib\Navigator\Modifiers\NavActive;
use Nurmanhabib\Navigator\NavCollection;

abstract class NavActivator
{
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

    public function hasActive(NavCollection $menu)
    {
        $result = false;

        foreach ($menu->getItems() as $nav) {
            if ($this->checkActive($nav)) {
                $result = true;
                break;
            }
        }

        return $result;
    }

    protected function checkActive(Nav $nav)
    {
        if ($nav->hasChild()) {
            return $this->hasActive($nav->getChild());
        }

        return $this->isActive($nav);
    }

    /**
     * @param Nav $nav
     * @return bool
     */
    abstract public function isActive(Nav $nav);

    public function makeActive(Nav $nav)
    {
        return new NavActive($nav);
    }
}
