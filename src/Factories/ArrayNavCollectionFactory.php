<?php

namespace Nurmanhabib\Navigator\Factories;

use Nurmanhabib\Navigator\NavCollection;

class ArrayNavCollectionFactory implements NavCollectionFactory
{
    /**
     * @var array
     */
    protected $items;

    /**
     * ArrayNavCollectionFactory constructor.
     *
     * @param array $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @return NavCollection
     */
    public function createNavCollection()
    {
        $items = array_map(function ($item) {
            return (new ArrayNavFactory($item))->createNav();
        }, $this->items);

        return new NavCollection($items);
    }
}
