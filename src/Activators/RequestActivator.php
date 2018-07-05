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
        $parsedUrl = parse_url($nav->getUrl());
        $path = array_key_exists('path', $parsedUrl) ? $parsedUrl['path'] : '/';
        $pathInfo = $this->request->getPathInfo();

        if ('/' === $path && '/' !== $pathInfo) {
            return false;
        }

        return substr($this->request->getPathInfo(), 0, strlen($path)) === $path;
    }
}
