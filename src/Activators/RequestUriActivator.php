<?php

namespace Nurmanhabib\Navigator\Activators;

class RequestUriActivator extends LinkActivator
{
    public function __construct()
    {
        parent::__construct($_SERVER['REQUEST_URI']);
    }
}
