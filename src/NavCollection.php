<?php

namespace Nurmanhabib\Navigator;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Collection;
use Nurmanhabib\Navigator\Items\Nav;
use Nurmanhabib\Navigator\Items\NavHeading;
use Nurmanhabib\Navigator\Items\NavHome;
use Nurmanhabib\Navigator\Items\NavLink;
use Nurmanhabib\Navigator\Items\NavParent;
use Nurmanhabib\Navigator\Items\NavSeparator;

class NavCollection implements Arrayable, Jsonable
{
    /**
     * Items of nav links
     *
     * @var Collection
     */
    protected $items;

    public function __construct($items = [])
    {
        $this->items = new Collection;

        foreach ($items as $item) {
            $this->add($item);
        }
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

        $child->items->each(function (Nav $nav) use ($parent) {
            $parent->add($nav);
        });

        return $parent;
    }

    public function add(Nav $item)
    {
        $this->items->push($item);

        return $item;
    }

    public function map(callable $callback)
    {
        $items = $this->items->map(function (Nav $nav) use ($callback) {
            return $this->mapNav($nav, $callback);
        });

        return new static($items);
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
        $this->items->transform(function (Nav $nav) use ($callback) {
            return $this->transformNav($nav, $callback);
        });

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

        $items = $this->items->reject(function (Nav $nav) use ($callback) {
            return $this->rejectNav($nav, $callback);
        });

        return new static($items);
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

        $items = $this->items->filter(function (Nav $nav) use ($callback) {
            return $this->filterNav($nav, $callback);
        });

        return new static($items);
    }

    protected function filterNav(Nav $nav, callable $callback)
    {
        $nav = clone $nav;

        if ($nav->hasChild()) {
            $nav->setChild($nav->getChild()->filter($callback));
        }

        return $callback($nav);
    }

    public function isEmpty()
    {
        return $this->items->isEmpty();
    }

    public function isNotEmpty()
    {
        return $this->items->isNotEmpty();
    }

    public function getItems()
    {
        return $this->items;
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
        return $this->items->map(function (Nav $item) {
            return $item->toArray();
        })->toArray();
    }
}
