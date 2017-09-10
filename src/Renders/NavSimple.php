<?php

namespace Nurmanhabib\Navigator\Renders;

use Nurmanhabib\Navigator\NavCollection;

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
