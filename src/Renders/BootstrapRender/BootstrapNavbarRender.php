<?php

namespace Nurmanhabib\Navigator\Renders\BootstrapRender;

use Nurmanhabib\Navigator\Items\Nav;
use Nurmanhabib\Navigator\Renders\NavHtmlRender;

class BootstrapNavbarRender extends NavHtmlRender
{
    /**
     * @param Nav $nav
     * @return string
     */
    public function renderItem(Nav $nav)
    {
        switch ($nav->getType()) {
            case 'link':
            case 'home':
                return vsprintf('<li class="nav-item"><a class="nav-link" href="%s">%s</a></li>', [
                    $nav->getUrl(),
                    $nav->getText(),
                ]);

            default:
                return '';
        }
    }

    /**
     * @param Nav $nav
     * @return string
     */
    public function renderItemActive(Nav $nav)
    {
        switch ($nav->getType()) {
            case 'link':
            case 'home':
                return vsprintf('<li class="nav-item"><a class="nav-link active" href="%s">%s</a></li>', [
                    $nav->getUrl(),
                    $nav->getText(),
                ]);

            default:
                return '';
        }
    }

    /**
     * @param Nav $nav
     * @return string
     */
    public function renderChild(Nav $nav)
    {
        $html = '<li class="nav-item dropdown">';
        $html .= '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
        $html .= $nav->getText();
        $html .= '</a>';
        $html .= $nav->getChild()->render(new BootstrapNavbarDropdownRender);
        $html .= '</li>';

        return $html;
    }

    /**
     * @param Nav $nav
     * @return string
     */
    public function renderChildActive(Nav $nav)
    {
        $html = '<li class="nav-item dropdown">';
        $html .= '<a class="nav-link active dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
        $html .= $nav->getText();
        $html .= '</a>';
        $html .= $nav->getChild()->render(new BootstrapNavbarDropdownRender);
        $html .= '</li>';

        return $html;
    }

    /**
     * @param string $html
     * @return string
     */
    public function renderWrapper($html)
    {
        return sprintf('<ul class="navbar-nav mr-auto">%s</ul>', $html);
    }
}
