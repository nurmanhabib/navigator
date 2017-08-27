<?php

namespace Nurmanhabib\Navigator\NavRender;

use Nurmanhabib\Navigator\NavCollection;
use Nurmanhabib\Navigator\NavRender;

class NavSimple implements NavRender
{
    /**
     * @param NavCollection $navigator
     * @return string
     */
    public function render(NavCollection $navigator)
    {
        return view('navigator::simple.menu', compact('navigator'));
    }
}
