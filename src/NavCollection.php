<?php

namespace Nurmanhabib\Navigator;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Collection;
use Nurmanhabib\Navigator\Items\Nav;
use Nurmanhabib\Navigator\Modifiers\NavModifier;

class NavCollection implements Arrayable, Jsonable
{
    /**
     * Items of nav links
     *
     * @var Collection
     */
    protected $items;

    public function __construct()
    {
        $this->items = new Collection;
    }

    public function add(Nav $item)
    {
        $this->items->push($item);

        return $item;
    }

    public function modify(NavModifier $modifier)
    {
        return $this->each(function (Nav $item) use ($modifier) {
            return $modifier->modify($item);
        });
    }

    public function each(callable $callable)
    {
        $this->items->map($callable);

        $this->items->each(function (Nav $item) use ($callable) {
            $this->eachChild($item, $callable);
        });

        return $this;
    }

    private function eachChild(Nav $item, callable $callable)
    {
        if ($item->hasChild()) {
            $item->child->each($callable);
        }
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
