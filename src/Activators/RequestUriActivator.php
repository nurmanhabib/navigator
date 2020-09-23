<?php

namespace Nurmanhabib\Navigator\Activators;

class RequestUriActivator extends LinkActivator
{
    public function __construct()
    {
        parent::__construct(key_exists('REQUEST_URI', $_SERVER) ? $_SERVER['REQUEST_URI'] : null);
    }
}
