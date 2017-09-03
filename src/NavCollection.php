<?php

namespace Nurmanhabib\Navigator;

use Illuminate\Support\Collection;

class NavCollection
{
    /**
     * @var Collection
     */
    protected $items;

    /**
     * @var string
     */
    protected $prefix = '';

    /**
     * @var string
     */
    protected $rootPrefix = '';

    /**
     * @var NavActivator
     */
    protected $activator;

    /**
     * @var bool
     */
    protected $activeInDepth = false;

    public function __construct()
    {
        $this->items = new Collection;
    }

    public function add(NavItem $item, NavCollection $child = null)
    {
        if ($this->prefix) {
            $item->setPrefix($this->prefix);
        }

        if ($child) {
            $child->rootPrefix($this->prefix);
            $child->applyPrefix();

            $item->setChild($child);
        }

        $this->items->push($item);

        return $item;
    }

    public function rootPrefix($rootPrefix = '')
    {
        $this->rootPrefix = $rootPrefix;

        $this->prefix($this->prefix);
    }

    public function prefix($prefix = '')
    {
        $stacks = [
            rtrim($this->rootPrefix, '/'),
            ltrim($prefix, '/'),
        ];

        $this->prefix = implode('/', array_filter($stacks, function ($stack) {
            return !empty($stack);
        }));

        $this->applyPrefix();
    }

    public function setActive($url)
    {
        $this->setActivator(new NavActivator([$url]));
    }

    public function setActivator(NavActivator $activator)
    {
        $this->activator = $activator;

        $this->applyActivator();
    }

    public function hasActive()
    {
        return $this->items->first(function (NavItem $item) {
            return $item->isActive();
        });
    }

    protected function applyPrefix()
    {
        $this->items->each(function (NavItem $item) {
            $item->setPrefix($this->prefix);
            $this->setChildRootPrefix($item);
        });
    }

    protected function setChildRootPrefix(NavItem $item)
    {
        if ($item->hasChild()) {
            $item->child->rootPrefix($this->prefix);
        }
    }

    protected function applyActivator()
    {
        $this->items->each(function (NavItem $item) {
            $this->checkActiveItem($item);
        });
    }

    protected function checkActiveItem(NavItem $item)
    {
        $item->setActive($active = $this->activator->isActive($item));
    }

    public function isEmpty()
    {
        return $this->items->isEmpty();
    }

    public function getItems()
    {
        return $this->items;
    }

    public function render(NavRender $render)
    {
        return $render->render($this);
    }

    public function toArray()
    {
        return $this->items->map(function (NavItem $item) {
            return $item->toArray();
        });
    }

    public function __toString()
    {
        return json_encode($this->toArray());
    }


}
