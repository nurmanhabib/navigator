<?php

namespace Nurmanhabib\Navigator\Modifiers;

class NavInvisible extends NavModifier
{
    public function isVisible()
    {
        return false;
    }
}
