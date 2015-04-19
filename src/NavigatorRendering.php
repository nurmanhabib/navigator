<?php namespace Nurmanhabib\Navigator;

class NavigatorRendering {

    protected $collection;
    protected $views;

    public function __construct(NavCollection $collection)
    {
        $this->collection   = $collection;

        $this->views = [
            'index'         => 'index',
            'item'          => 'item',
            'item_active'   => 'item_active',
            'item_disabled' => 'item_disabled',
            'child'         => 'child',
            'child_active'  => 'child_active',
        ];

        $this->generateView();
    }

    private function generateView()
    {
        array_walk($this->views, [$this, 'setFullView']);
        array_walk($this->views, [$this, 'checkViewExists']); 
    }

    private function setFullView($name, $key)
    {
        $this->views[$key] = $this->collection->template . '.' . $name;
    }

    private function checkViewExists($name, $key)
    {
        if (!view()->exists($name))
            $this->views[$key] = $this->views['item'];
    }

    public function render()
    {
        $view   = $this->views['index'];
        $data   = ['collection' => $this->collection, 'items' => $this->renderItems()];

        return view($view, $data)->render();
    }

    public function renderItems(NavCollection $collection = null)
    {
        $collection = $collection ?: $this->collection;
        $rendered   = '';

        foreach ($collection->items as $item)
            $rendered .= $this->generateItem($item);

        return $rendered;
    }

    public function generateItem(NavItem $item)
    {
        $view   = 'item';
        $data   = ['item' => $item];
        $active = $this->collection->active;

        if ($item->hasChild()) {
            $data = array_merge($data, ['child' => $item->child]);

            if ($item->child->isActive())
                $view = 'child_active';
            else
                $view = 'child';

        } elseif ($item->isActive()) {

            $view = 'item_active';

        } else {

            $view = 'item';

        }

        return view($this->views[$view], $data)->render();
    }

    public function __toString()
    {
        return $this->render();
    }

}