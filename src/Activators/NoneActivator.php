<?php

namespace Nurmanhabib\Navigator\Activators;

use Nurmanhabib\Navigator\Items\Nav;

class NoneActivator extends NavActivator
{
    public function isActive(Nav $nav)
    {
        return false;
    }
}
