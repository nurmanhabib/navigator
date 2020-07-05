<?php

namespace Nurmanhabib\Navigator;

use Nurmanhabib\Navigator\Factories\ArrayNavFactory;
use Nurmanhabib\Navigator\Items\Nav;
use Nurmanhabib\Navigator\Items\NavHeading;
use Nurmanhabib\Navigator\Items\NavHome;
use Nurmanhabib\Navigator\Items\NavLink;
use Nurmanhabib\Navigator\Items\NavParent;
use Nurmanhabib\Navigator\Items\NavSeparator;
use Nurmanhabib\Navigator\Renders\NavRender;
use Nurmanhabib\Navigator\Renders\NavSimple;

class NavCollection
{
    /**
     * Items of nav links
     *
     * @var array
     */
    protected $items;

    /**
     * @var NavRender
     */
    protected $renderer;

    public function __construct($items = [], NavRender $renderer = null)
    {
        $this->items = [];

        // Default Renderer
        $this->renderer = $renderer ?: new NavSimple;

        foreach ($items as $item) {
            $this->add($item);
        }
    }

    public function addArrays(array $items)
    {
        foreach ($items as $item) {
            $this->addArray($item);
        }

        return $this;
    }

    public function addArray(array $item)
    {
        $navFactory = new ArrayNavFactory($item);

        return $this->add($nav = $navFactory->createNav());
    }

    public function addLink($text, $url = '#', $icon = null)
    {
        return $this->add(new NavLink($text, $url, $icon));
    }

    public function addHeading($text)
    {
        return $this->add(new NavHeading($text));
    }

    public function addHome($text = 'Home', $url = '/', $icon = 'home')
    {
        return $this->add(new NavHome($text, $url, $icon));
    }

    public function addSeparator()
    {
        return $this->add(new NavSeparator);
    }

    public function addParent($text, callable $callback, $icon = null, $url = '#')
    {
        $parent = $this->add(new NavParent($text, $url, $icon));

        $callback($child = new self);

        $parent->setChild($child);

        return $parent;
    }

    public function add(Nav $item)
    {
        $this->items[] = $item;

        return $item;
    }

    public function map(callable $callback)
    {
        $items = array_map(function (Nav $nav) use ($callback) {
            return $this->mapNav($nav, $callback);
        }, $this->items);

        return new static($items, $this->renderer);
    }

    protected function mapNav(Nav $nav, callable $callback)
    {
        $nav = clone $nav;

        if ($nav->hasChild()) {
            $nav->setChild($nav->getChild()->map($callback));
        }

        return $callback($nav);
    }

    public function transform(callable $callback)
    {
        $this->items = array_map(function (Nav $nav) use ($callback) {
            return $this->transformNav($nav, $callback);
        }, $this->items);

        return $this;
    }

    protected function transformNav(Nav $nav, callable $callback)
    {
        if ($nav->hasChild()) {
            $nav->getChild()->transform($callback);
        }

        return $callback($nav);
    }

    public function reject(callable $callback = null)
    {
        if (!$callback) {
            $callback = function (Nav $nav) {
                return $nav->isVisible();
            };
        }

        $items = array_filter($this->items, function (Nav $nav) use ($callback) {
            return !$this->rejectNav($nav, $callback);
        });

        return new static($items, $this->renderer);
    }

    protected function rejectNav(Nav $nav, callable $callback)
    {
        $nav = clone $nav;

        if ($nav->hasChild()) {
            $nav->setChild($nav->getChild()->reject($callback));
        }

        return $callback($nav);
    }

    public function filter(callable $callback = null)
    {
        if (!$callback) {
            $callback = function (Nav $nav) {
                return $nav->isVisible();
            };
        }

        $items = array_filter($this->items, function (Nav $nav) use ($callback) {
            return $this->filterNav($nav, $callback);
        });

        return new static($items, $this->renderer);
    }

    protected function filterNav(Nav $nav, callable $callback)
    {
        $nav = clone $nav;

        if ($nav->hasChild()) {
            $nav->setChild($nav->getChild()->filter($callback));
        }

        return $callback($nav);
    }

    public function isNotEmpty()
    {
        return !$this->isEmpty();
    }

    public function isEmpty()
    {
        return empty($this->items);
    }

    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param NavRender $renderer
     */
    public function setRenderer(NavRender $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * @return NavRender
     */
    public function getRenderer()
    {
        return $this->renderer;
    }

    public function render(NavRender $renderer = null)
    {
        $renderer = $renderer ?: $this->renderer;

        return $renderer->render($this);
    }

    /**
     * Convert the object to its JSON representation.
     *
     * @param  int $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->toArray(), $options);
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return array_map(function (Nav $item) {
            return $item->toArray();
        }, $this->items);
    }
}
