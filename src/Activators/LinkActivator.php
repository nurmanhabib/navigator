<?php

namespace Nurmanhabib\Navigator\Activators;

use Nurmanhabib\Navigator\Items\Nav;
use Nurmanhabib\Navigator\Modifiers\NavModifier;

class LinkActivator extends NavActivator
{
    protected $uri;

    /**
     * LinkActivator constructor.
     * @param $uri
     */
    public function __construct($uri)
    {
        $this->uri = $uri;
    }

    public function isActive(Nav $nav)
    {
        return $this->matchPath($nav) && $this->matchQuery($nav) && $this->matchFragment($nav);
    }

    protected function matchPath(Nav $nav)
    {
        $pathPattern = trim(parse_url($this->uri, PHP_URL_PATH), '/') . '/';
        $navPattern = ltrim($nav->getPattern(), '/');

        if (empty($navPattern)) {
            return false;
        }

        return strpos($pathPattern, $navPattern) !== false || fnmatch($navPattern, $pathPattern);
    }

    protected function matchQuery(Nav $nav)
    {
        $expectedQuery = parse_url($this->uri, PHP_URL_QUERY);
        $navQuery = parse_url($nav->getPattern(), PHP_URL_QUERY);

        parse_str($expectedQuery, $expectedQuery);
        parse_str($navQuery, $navQuery);

        return empty(array_diff($navQuery, $expectedQuery));
    }

    protected function matchFragment(Nav $nav)
    {
        $expectedFragment = parse_url($this->uri, PHP_URL_FRAGMENT);
        $navFragment = parse_url($nav->getPattern(), PHP_URL_FRAGMENT);

        return $expectedFragment === $navFragment;
    }
}
