<?php

namespace Nurmanhabib\Navigator;

use Nurmanhabib\Navigator\Activators\NavActivator;
use Nurmanhabib\Navigator\Activators\NoneActivator;
use Nurmanhabib\Navigator\Items\Nav;
use Nurmanhabib\Navigator\Modifiers\NavActive;
use Nurmanhabib\Navigator\Renders\NavRender;
use Nurmanhabib\Navigator\Renders\NavSimple;

class Navigator
{
    /**
     * @var NavCollection
     */
    protected $menu;

    /**
     * @var NavActivator
     */
    protected $activator;

    /**
     * @var NavRender
     */
    protected $render;

    /**
     * Navigator constructor.
     * @param NavCollection $menu
     */
    public function __construct(NavCollection $menu)
    {
        $this->menu = $menu;
        $this->activator = new NoneActivator;
        $this->render = new NavSimple;
    }

    public function map(callable $callback)
    {
        return new static($this->menu->map($callback));
    }

    public function transform(callable $callback)
    {
        $this->menu->transform($callback);

        return $this;
    }

    public function setActivator(NavActivator $activator)
    {
        $this->activator = $activator;

        return $this;
    }

    public function setRender(NavRender $render)
    {
        $this->render = $render;

        return $this;
    }

    public function applyActivator()
    {
        $this->transform(function (Nav $nav) {
            if ($this->activator->isActive($nav)) {
                return new NavActive($nav);
            }

            return $nav;
        });
    }

    public function render()
    {
        return $this->render->render($this->menu);
    }

    public function toArray()
    {
        return $this->menu->toArray();
    }

    public function toJson($options = 0)
    {
        return $this->menu->toJson($options);
    }
}
