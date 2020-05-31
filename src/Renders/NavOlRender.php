<?php

namespace Nurmanhabib\Navigator\Renders;

class NavOlRender extends NavSimple
{
    /**
     * @param string $html
     * @return string
     */
    public function renderWrapper($html)
    {
        return sprintf('<ol>%s</ol>', $html);
    }
}
