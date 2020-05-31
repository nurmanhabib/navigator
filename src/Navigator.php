<?php

namespace Nurmanhabib\Navigator;

use Nurmanhabib\Navigator\Activators\LinkActivator;
use Nurmanhabib\Navigator\Activators\NavActivator;
use Nurmanhabib\Navigator\Activators\RequestUriActivator;
use Nurmanhabib\Navigator\Renders\NavRender;

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
     * Navigator constructor.
     * @param NavCollection $menu
     * @param NavActivator|null $activator
     */
    public function __construct(NavCollection $menu, NavActivator $activator = null)
    {
        $this->menu = $menu;
        $this->activator = $activator ?: new RequestUriActivator;
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

    public function map(callable $callback)
    {
        return new static($this->menu->map($callback));
    }

    public function transform(callable $callback)
    {
        $this->menu->transform($callback);

        return $this;
    }

    public function reject(callable $callback = null)
    {
        return new static($this->menu->reject($callback), $this->activator);
    }

    public function filter(callable $callback = null)
    {
        return new static($this->menu->filter($callback), $this->activator);
    }

    public function toArray()
    {
        return $this->getMenu()->toArray();
    }

    public function getMenu()
    {
        return $this->activator->apply($this->getOriginalMenu()->filter());
    }

    public function getOriginalMenu()
    {
        return $this->menu;
    }

    public function render(NavRender $renderer = null)
    {
        return $this->getMenu()->render($renderer);
    }

    public function toJson($options = 0)
    {
        return $this->getMenu()->toJson($options);
    }

    public function __toString()
    {
        return (string)$this->render();
    }
}
