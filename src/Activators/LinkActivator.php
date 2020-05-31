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
        $pathPattern = ltrim(parse_url($this->uri, PHP_URL_PATH), '/');
        $navPath = ltrim(parse_url($nav->getPattern(), PHP_URL_PATH), '/');

        return fnmatch($pathPattern, $navPath) || fnmatch($navPath, $pathPattern);
    }

    protected function matchQuery(Nav $nav)
    {
        $expectedQuery = parse_url($this->uri, PHP_URL_QUERY);
        $navQuery = parse_url($nav->getPattern(), PHP_URL_QUERY);

        parse_str($expectedQuery, $expectedQuery);
        parse_str($navQuery, $navQuery);

        return empty(array_diff($expectedQuery, $navQuery));
    }

    protected function matchFragment(Nav $nav)
    {
        $expectedFragment = parse_url($this->uri, PHP_URL_FRAGMENT);
        $navFragment = parse_url($nav->getPattern(), PHP_URL_FRAGMENT);

        return $expectedFragment === $navFragment;
    }
}
