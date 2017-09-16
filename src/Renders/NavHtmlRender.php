<?php

namespace Nurmanhabib\Navigator\Renders;

use Nurmanhabib\Navigator\Items\Nav;
use Nurmanhabib\Navigator\NavCollection;

abstract class NavHtmlRender implements NavRender
{
    public function render(NavCollection $menu)
    {
        $html = '';

        foreach ($menu->getItems() as $nav) {
            $html .= $this->renderNav($nav);
        }

        return $this->renderWrapper($html);
    }

    protected function renderNav(Nav $nav)
    {
        if ($nav->hasChild()) {
            return $this->renderNavChild($nav);
        }

        if ($nav->isActive()) {
            return $this->renderItemActive($nav);
        }

        return $this->renderItem($nav);
    }

    protected function renderNavChild(Nav $nav)
    {
        if ($nav->isActive()) {
            return $this->renderChildActive($nav);
        }

        return $this->renderChild($nav);
    }

    /**
     * @param Nav $nav
     * @return string
     */
    abstract public function renderChildActive(Nav $nav);

    /**
     * @param Nav $nav
     * @return string
     */
    abstract public function renderChild(Nav $nav);

    /**
     * @param Nav $nav
     * @return string
     */
    abstract public function renderItemActive(Nav $nav);

    /**
     * @param Nav $nav
     * @return string
     */
    abstract public function renderItem(Nav $nav);

    /**
     * @param string $html
     * @return string
     */
    abstract public function renderWrapper($html);
}
