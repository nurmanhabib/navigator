<?php

namespace Nurmanhabib\Navigator\Items;

use Nurmanhabib\Navigator\NavCollection;

interface Nav
{
    /**
     * The text to be displayed on the menu
     *
     * @return string
     */
    public function getText();

    /**
     * URL to be processed as a hyperlink
     *
     * @return string
     */
    public function getUrl();

    /**
     * The name of the icon to use
     *
     * @return string
     */
    public function getIcon();

    /**
     * Checking an active menu
     *
     * @return bool
     */
    public function isActive();

    /**
     * Checking a menu is visible
     *
     * @return bool
     */
    public function isVisible();

    /**
     * @return bool
     */
    public function hasChild();

    /**
     * @return NavCollection
     */
    public function getChild();

    /**
     * @param NavCollection $child
     * @return NavCollection
     */
    public function setChild(NavCollection $child);

    /**
     * @return array
     */
    public function getPattern();

    /**
     * @return bool
     */
    public function patternIsMatchExact();

    /**
     * @param Nav $nav
     * @return Nav
     */
    public function add(Nav $nav);

    /**
     * @return string
     */
    public function getType();

    /**
     * @param array $data
     * @return Nav
     */
    public function setData(array $data);

    /**
     * @param string $key
     * @param string $default
     * @return array
     */
    public function getData($key = null, $default = null);

    /**
     * @param $key
     * @return array
     */
    public function hasData($key);

    /**
     * @return array
     */
    public function toArray();

    /**
     * @param int $options
     * @return string
     */
    public function toJson($options = 0);
}
