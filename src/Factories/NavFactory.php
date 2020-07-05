<?php

namespace Nurmanhabib\Navigator\Factories;

use Nurmanhabib\Navigator\Items\Nav;

interface NavFactory
{
    /**
     * @return Nav
     */
    public function createNav();
}