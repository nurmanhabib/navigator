<?php

namespace Nurmanhabib\Navigator\Renders;

use Nurmanhabib\Navigator\Items\Nav;

class NavSimple extends NavHtmlRender
{
    /**
     * @param Nav $nav
     * @return string
     */
    public function renderItemActive(Nav $nav)
    {
        return vsprintf('<li><strong><a href="%s">%s</a></strong></li>', [
            $nav->getUrl(),
            $nav->getText(),
        ]);
    }

    /**
     * @param Nav $nav
     * @return string
     */
    public function renderItem(Nav $nav)
    {
        return vsprintf('<li><a href="%s">%s</a></li>', [
            $nav->getUrl(),
            $nav->getText(),
        ]);
    }

    /**
     * @param Nav $nav
     * @return string
     */
    public function renderChildActive(Nav $nav)
    {
        return vsprintf('<li><strong><a href="%s">%s</a></strong>%s</li>', [
            $nav->getUrl(),
            $nav->getText(),
            $this->render($nav->getChild()),
        ]);
    }

    /**
     * @param Nav $nav
     * @return string
     */
    public function renderChild(Nav $nav)
    {
        return vsprintf('<li><a href="%s">%s</a>%s</li>', [
            $nav->getUrl(),
            $nav->getText(),
            $this->render($nav->getChild()),
        ]);
    }

    /**
     * @param string $html
     * @return string
     */
    public function renderWrapper($html)
    {
        return sprintf('<ul>%s</ul>', $html);
    }
}
