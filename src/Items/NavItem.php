<?php

namespace Nurmanhabib\Navigator\Items;

use Nurmanhabib\Navigator\Exceptions\NavChildException;
use Nurmanhabib\Navigator\NavCollection;

abstract class NavItem implements Nav
{
    use NavDataTrait;

    protected $active = false;

    protected $visible = true;

    protected $patterns = [];

    abstract public function getText();

    abstract public function getUrl();

    abstract public function getIcon();

    abstract public function getType();

    public function isActive()
    {
        return $this->active;
    }

    public function setInactive($inactive = true)
    {
        return $this->setActive(!$inactive);
    }

    public function setActive($active = true)
    {
        $this->active = $active;

        return $this;
    }

    public function isVisible()
    {
        return $this->visible;
    }

    public function setVisible($visible = true)
    {
        $this->visible = $visible;

        return $this;
    }

    public function setInvisible($invisible = true)
    {
        return $this->setVisible(!$invisible);
    }

    public function hasChild()
    {
        return false;
    }

    public function getChild()
    {
        return new NavCollection;
    }

    public function setChild(NavCollection $child)
    {
        throw new NavChildException($this);
    }

    public function add(Nav $item)
    {
        throw new NavChildException($this);
    }

    public function match($pattern)
    {
        if (is_array($pattern)) {
            return $this->matches($pattern);
        }

        $this->patterns[] = '/' . ltrim($pattern, '/');

        return $this;
    }

    public function matches(array $patterns = [])
    {
        foreach ($patterns as $pattern) {
            $this->match((string)$pattern);
        }

        return $this;
    }

    public function getPattern()
    {
        if (empty($this->patterns)) {
            $this->match(parse_url($this->getUrl(), PHP_URL_PATH));
        }

        return $this->patterns;
    }

    public function toJson($options = 0)
    {
        return json_encode($this->toArray(), $options);
    }

    public function toArray()
    {
        return [
            'text' => $this->getText(),
            'url' => $this->getUrl(),
            'icon' => $this->getIcon(),
            'type' => $this->getType(),
            'is_active' => $this->isActive(),
            'is_visible' => $this->isVisible(),
            'has_child' => $this->hasChild(),
            'data' => $this->getData(),
            'child' => $this->getChild()->toArray(),
        ];
    }

    public function __toString()
    {
        return $this->toJson();
    }
}
