<?php

namespace Nurmanhabib\Navigator\NavRender;

use Nurmanhabib\Navigator\NavCollection;
use Nurmanhabib\Navigator\NavRender;

class MetisMenu implements NavRender
{
    protected $id;

    /**
     * MestisMenu constructor.
     * @param string $id
     */
    public function __construct($id = 'menu')
    {
        $this->id = $id;
    }

    /**
     * @param NavCollection $navigator
     * @return string
     */
    public function render(NavCollection $navigator)
    {
        $id = $this->id;

        return view('navigator::metis-menu.menu', compact('navigator', 'id'));
    }
}
