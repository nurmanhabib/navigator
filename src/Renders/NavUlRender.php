<?php

namespace Nurmanhabib\Navigator\Renders;

class NavUlRender extends NavSimple
{
    /**
     * @param string $html
     * @return string
     */
    public function renderWrapper($html)
    {
        return sprintf('<ul>%s</ul>', $html);
    }
}