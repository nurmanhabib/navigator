<?php

namespace Nurmanhabib\Navigator\Modifiers;

class NavInactive extends NavActive
{
    public function isActive()
    {
        return false;
    }
}
