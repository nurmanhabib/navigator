<?php

namespace Nurmanhabib\Navigator\Activators;

use Nurmanhabib\Navigator\Items\Nav;
use Nurmanhabib\Navigator\Modifiers\NavModifier;

class LinkActivator extends NavActivator
{
    protected $url;

    /**
     * LinkActivator constructor.
     * @param $url
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    public function isActive(Nav $nav)
    {
        if ($nav instanceof NavModifier) {
            return $nav->getOriginalNav()->getUrl() === $this->url;
        }

        return $nav->getUrl() === $this->url;
    }
}
