<?php

namespace Nurmanhabib\Navigator;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Nurmanhabib\Navigator\Activators\LinkActivator;
use Nurmanhabib\Navigator\Activators\NavActivator;
use Nurmanhabib\Navigator\Activators\NoneActivator;
use Nurmanhabib\Navigator\Renders\NavRender;
use Nurmanhabib\Navigator\Renders\NavSimple;

class Navigator implements Arrayable, Jsonable
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

    public function setActive($url = '/')
    {
        return $this->setActivator(new LinkActivator($url));
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

    public function render(NavRender $render = null)
    {
        $render = $render ?: $this->render;

        return $render->render($this->getMenu());
    }

    public function getMenu()
    {
        return $this->activator->apply($this->getOriginalMenu());
    }

    public function getOriginalMenu()
    {
        return $this->menu;
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

    public function toArray()
    {
        return $this->getMenu()->toArray();
    }

    public function toJson($options = 0)
    {
        return $this->getMenu()->toJson($options);
    }

    public function __toString()
    {
        return (string) $this->render();
    }
}
