<?php

namespace Nurmanhabib\Navigator\Exceptions;

use Exception;
use Nurmanhabib\Navigator\Items\Nav;

class NavChildException extends Exception
{
    protected $parent;

    public function __construct(Nav $parent)
    {
        parent::__construct($parent->getType() . ' does not support child menu additions');

        $this->parent = $parent;
    }

    public function getNavParent()
    {
        return $this->parent;
    }
}
