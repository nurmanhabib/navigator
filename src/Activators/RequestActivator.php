<?php

namespace Nurmanhabib\Navigator\Activators;

use Illuminate\Http\Request;
use Nurmanhabib\Navigator\Items\Nav;

class RequestActivator extends NavActivator
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * RequestActivator constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function isActive(Nav $nav)
    {
        return $this->request->is($nav->getUrl());
    }
}
