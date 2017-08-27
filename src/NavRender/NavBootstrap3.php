<?php

namespace Nurmanhabib\Navigator\NavRender;

use Nurmanhabib\Navigator\NavCollection;
use Nurmanhabib\Navigator\NavRender;

class NavBootstrap3 implements NavRender
{
    /**
     * @param NavCollection $navigator
     * @return string
     */
    public function render(NavCollection $navigator)
    {
        return view('navigator::bootstrap3.menu', compact('navigator'));
    }
}
