<?php

namespace Nurmanhabib\Navigator\Modifiers;

class NavInactive extends NavModifier
{
    public function isActive()
    {
        return false;
    }
}
