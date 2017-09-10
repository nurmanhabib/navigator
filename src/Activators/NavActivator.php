<?php

namespace Nurmanhabib\Navigator\Activators;

use Nurmanhabib\Navigator\Items\Nav;

interface NavActivator
{
    public function isActive(Nav $nav);
}
