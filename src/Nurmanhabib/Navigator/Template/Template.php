<?php namespace Nurmanhabib\Navigator\Template;

use Nurmanhabib\Navigator\Nav;
use View;

class Template {

    protected $nav;

    protected $view;

    public function __construct(Nav $nav, $view = null)
    {
        $this->nav = $nav;
        
        if (!empty($view))
            $this->view = $view;
    }

    public function getItem($text, $url)
    {
        return '<li><a href="'.$url.'">'.$text.'</a></li>';
    }

    public function getDisabledItem($text, $url)
    {
        return '<li class="disabled"><span>'.$text.'</span></li>';
    }

    public function getActiveItem($text, $url)
    {
        return '<li class="active"><a href="'.$url.'">'.$text.'</a></li>';
    }

    public function getItemParent($text, Nav $nav)
    {
        return '<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">'.$text.' <span class="caret"></span></a>'.$nav->links().'</li>';
    }

    public function render()
    {
        return View::make($this->view, ['nav' => $this->nav, 'list' => $this->renderList()]);
    }

    public function renderList()
    {
        $html = '';

        foreach ($this->nav->list as $text => $url) {
            if ($this->nav->active == $url)
                $html .= $this->getActiveItem($text, $url);
            else
                $html .= $this->getItem($text, $url);
        }

        return $html;
    }

}