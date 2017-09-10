<?php

namespace Nurmanhabib\Navigator\Activators;

use Nurmanhabib\Navigator\Items\Nav;

class NoneActivator implements NavActivator
{
    public function isActive(Nav $nav)
    {
        return false;
    }
}
