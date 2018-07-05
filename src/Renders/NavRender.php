<?php

namespace Nurmanhabib\Navigator\Renders;

use Nurmanhabib\Navigator\NavCollection;

interface NavRender
{
    public function render(NavCollection $menu);
}
