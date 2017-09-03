<?php

namespace Nurmanhabib\Navigator;

use Illuminate\Http\Request;

class NavActivator
{
    protected $activeURLs = [];

    /**
     * @var Request
     */
    protected $request = null;

    /**
     * @var \Closure
     */
    protected $itemCallback = null;

    public function __construct(array $activeURLs = null)
    {
        if ($activeURLs) {
            $this->fromURLs($activeURLs);
        }
    }

    public function fromURL($activeURL)
    {
        $this->fromURLs([$activeURL]);
    }

    public function fromRequest(Request $request)
    {
        $this->fromURL($request->fullUrl());
        $this->request = $request;
    }

    public function fromURLs(array $activeURLs)
    {
        $this->activeURLs = $activeURLs;
    }

    public function whereItem(\Closure $callback)
    {
        $this->itemCallback = $callback;
    }

    public function isActive(NavItem $item)
    {
        if ($result = $this->checkActiveFromChild($item)) {
            return $result;
        }

        if ($result = $this->checkActiveFromArray($item)) {
            return $result;
        }

        if ($result = $this->checkActiveFromRequest($item)) {
            return $result;
        }

        if ($callback = $this->itemCallback) {
            return $callback($item);
        }

        return false;
    }

    protected function checkActiveFromChild(NavItem $item)
    {
        return $this->isActiveChild($item->child);
    }

    protected function isActiveChild(NavCollection $child)
    {
        $child->setActivator($this);

        return $child->hasActive();
    }

    protected function checkActiveFromArray(NavItem $item)
    {
        return in_array($item->url, $this->activeURLs);
    }

    protected function checkActiveFromRequest(NavItem $item)
    {
        if ($request = $this->request) {
            $path = parse_url($item->url, PHP_URL_PATH);

            return $request->is(trim($path, '/') . '/*');
        }

        return false;
    }
}
