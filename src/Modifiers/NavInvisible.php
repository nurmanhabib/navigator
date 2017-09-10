<?php

namespace Nurmanhabib\Navigator\Modifiers;

class NavInvisible extends NavVisible
{
    public function isVisible()
    {
        return false;
    }
}
