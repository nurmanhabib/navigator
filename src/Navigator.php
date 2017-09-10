<?php

namespace Nurmanhabib\Navigator;

use Illuminate\Http\Request;
use Nurmanhabib\Navigator\Items\NavLink;

class Navigator
{
    /**
     * @var array
     */
    protected static $navigators;

    /**
     * @var NavCollection
     */
    protected static $currentNavigator;

    /**
     * @var array
     */
    protected static $childNavigatorStack = [];

    /**
     * @var NavActivator
     */
    protected static $globalActivator;

    /**
     * @param $name
     * @param \Closure $callback
     */
    public static function make($name, \Closure $callback)
    {
        self::$currentNavigator = self::$navigators[$name] = new NavCollection;

        if ($activator = self::$globalActivator) {
            self::$currentNavigator->setActivator($activator);
        }

        $callback(self::$currentNavigator);
    }

    /**
     * @param $name
     * @param \Closure|null $callback
     *
     * @return NavCollection|null
     */
    public static function get($name = 'default', \Closure $callback = null)
    {
        if (is_null($callback)) {
            return self::$navigators[$name];
        }

        $callback(self::$currentNavigator = self::$navigators[$name]);
    }

    public static function link($text, $url, $icon = null)
    {
        return self::add(new NavLink($text, $url, $icon));
    }

    public static function child($text, \Closure $callback, $icon = null, $url = '#')
    {
        $parent = new NavLink($text, $url, $icon);
        $child = self::$childNavigatorStack[] = new NavCollection;

        $callback($child, $parent);

        array_pop(self::$childNavigatorStack);

        return self::add($parent, $child);
    }

    public static function add(NavLink $item, NavCollection $child = null)
    {
        $currentNavigator = self::getLastChildStack() ?: self::$currentNavigator;

        if (!$currentNavigator) {
            $currentNavigator = self::$currentNavigator = self::$navigators['default'] = new NavCollection;
        }

        return $currentNavigator->add($item, $child);
    }

    protected static function getLastChildStack()
    {
        return end(self::$childNavigatorStack);
    }

    public static function setActive($url)
    {
        $activator = self::$globalActivator ?: new NavActivator;
        $activator->fromURL($url);

        self::setActivator($activator);
    }

    public static function setActiveFromRequest(Request $request = null)
    {
        $activator = self::$globalActivator ?: new NavActivator;
        $activator->fromRequest($request ?: request());

        self::setActivator($activator);
    }

    public static function setActivator(NavActivator $activator)
    {
        self::$globalActivator = $activator;

        foreach (self::$navigators as $name => $navigator) {
            $navigator->setActivator($activator);
        }
    }

    public static function toArray()
    {
        return array_map(function (NavCollection $navigator) {
            return $navigator->toArray();
        }, self::$navigators);
    }

    public static function toJson($options = 0)
    {
        return json_encode(self::toArray(), $options);
    }

    public static function all()
    {
        return self::$navigators;
    }
}
