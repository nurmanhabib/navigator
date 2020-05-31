<?php

namespace Nurmanhabib\Navigator\Renders\BootstrapRender;

use Nurmanhabib\Navigator\Items\Nav;
use Nurmanhabib\Navigator\Renders\NavHtmlRender;

class BootstrapNavbarDropdownRender extends NavHtmlRender
{
    /**
     * @var string
     */
    protected $dropdownId;

    /**
     * BootstrapNavbarDropdownRender constructor.
     *
     * @param string $dropdownId
     */
    public function __construct($dropdownId = null)
    {
        $this->dropdownId = $dropdownId;
    }

    /**
     * @param Nav $nav
     * @return string
     */
    public function renderItem(Nav $nav)
    {
        switch ($nav->getType()) {
            case 'link':
            case 'home':
                return vsprintf('<a class="dropdown-item" href="%s">%s</a>', [
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
                return vsprintf('<a class="dropdown-item" href="%s">%s</a>', [
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
        return '';
    }

    /**
     * @param Nav $nav
     * @return string
     */
    public function renderChildActive(Nav $nav)
    {
        return '';
    }

    /**
     * @param string $html
     * @return string
     */
    public function renderWrapper($html)
    {
        if ($this->dropdownId) {
            return sprintf('<div class="dropdown-menu" aria-labelledby="' . $this->dropdownId . '">%s</div>', $html);
        } else {
            return sprintf('<div class="dropdown-menu">%s</div>', $html);
        }
    }
}
