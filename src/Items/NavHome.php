<?php

namespace Nurmanhabib\Navigator\Items;

class NavHome extends NavLink
{
    public function __construct($text = 'Home', $url = '/', $icon = 'home')
    {
        parent::__construct($text, $url, $icon);
    }

    public function getType()
    {
        return 'home';
    }
}
