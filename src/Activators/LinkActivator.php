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
        $currentPath = parse_url($this->uri, PHP_URL_PATH);

        $match = null;

        foreach ($nav->getPattern() as $navPattern) {
            if (empty($navPattern)) {
                continue;
            }

            $navPath = parse_url($navPattern, PHP_URL_PATH);
            $match = strpos($currentPath, $navPath) !== false || fnmatch($navPath, $currentPath);

            if ($match) {
                break;
            }
        }

        return $match === true;
    }

    protected function matchQuery(Nav $nav)
    {
        $expectedQuery = parse_url($this->uri, PHP_URL_QUERY);

        parse_str($expectedQuery, $expectedQuery);

        $match = null;

        foreach ($nav->getPattern() as $navPattern) {
            $navQuery = parse_url($navPattern, PHP_URL_QUERY);

            parse_str($navQuery, $navQuery);

            $match = empty(array_diff($navQuery, $expectedQuery));

            if ($match) {
                break;
            }
        }

        return $match === true;
    }

    protected function matchFragment(Nav $nav)
    {
        $expectedFragment = parse_url($this->uri, PHP_URL_FRAGMENT);

        $match = null;

        foreach ($nav->getPattern() as $navPattern) {
            $navFragment = parse_url($navPattern, PHP_URL_FRAGMENT);

            $match = $expectedFragment === $navFragment;

            if ($match) {
                break;
            }
        }

        return $match === true;
    }
}
