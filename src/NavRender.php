<?php

namespace Nurmanhabib\Navigator;

interface NavRender
{
    /**
     * @param NavCollection $navigator
     * @return string
     */
    public function render(NavCollection $navigator);
}
