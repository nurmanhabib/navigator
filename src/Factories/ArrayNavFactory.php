<?php

namespace Nurmanhabib\Navigator\Factories;

use Nurmanhabib\Navigator\Exceptions\InvalidNavTypeException;
use Nurmanhabib\Navigator\Items\Nav;
use Nurmanhabib\Navigator\Items\NavHeading;
use Nurmanhabib\Navigator\Items\NavHome;
use Nurmanhabib\Navigator\Items\NavLink;
use Nurmanhabib\Navigator\Items\NavParent;
use Nurmanhabib\Navigator\Items\NavSeparator;

class ArrayNavFactory implements NavFactory
{
    /**
     * @var array
     */
    protected $data;

    /**
     * ArrayNavFactory constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return Nav
     *
     * @throws InvalidNavTypeException
     */
    public function createNav()
    {
        switch ($this->getValue('type', 'link')) {
            case 'heading':
                $nav = new NavHeading($this->getValue('text'));
                break;

            case 'separator':
                $nav = new NavSeparator;
                break;

            case 'home':
                $nav = new NavHome($this->getValue('text'), $this->getValue('url'), $this->getValue('icon'));
                break;

            case 'link':
                $nav = $this->makeNavLinkOrParent();
                break;

            default:
                throw new InvalidNavTypeException($this->getValue('type'));
        }

        if ($this->hasKey('data')) {
            $nav->setData($this->getValue('data', []));
        }

        if ($this->hasKey('is_active')) {
            $nav->setActive((bool)$this->getValue('is_active'));
        }

        if ($this->hasKey('is_visible')) {
            $nav->setVisible((bool)$this->getValue('is_visible'));
        }

        if ($this->hasKey('match')) {
            $nav->match($this->getValue('match'));
        }

        return $nav;
    }

    protected function makeNavLinkOrParent()
    {
        $children = $this->getValue('child', []);

        if (!empty($children)) {
            $navCollectionFactory = new ArrayNavCollectionFactory($children);

            $nav = new NavParent($this->getValue('text'), $this->getValue('url'), $this->getValue('icon'));
            $nav->setChild($navCollectionFactory->createNavCollection());

            return $nav;
        }

        return new NavLink($this->getValue('text'), $this->getValue('url'), $this->getValue('icon'));
    }

    protected function hasKey($key)
    {
        return array_key_exists($key, $this->data);
    }

    protected function getValue($key, $default = null)
    {
        if (!$this->hasKey($key)) {
            return $default;
        }

        return $this->data[$key];
    }
}
