<?php namespace Nurmanhabib\Navigator\Template;

use Nurmanhabib\Navigator\Nav;

class SBAdmin2 extends Template {

    protected $view = 'navigator::sb-admin-2';

    public function getActiveItem($text, $url)
    {
        return '<li><a href="'.$url.'" class="active">'.$text.'</a></li>';
    }

    public function getChild($text, Nav $nav)
    {
        return '<li><a href="#">'.$text.' <span class="fa arrow"></span></a>'.$nav->setTemplate('sb-admin-2-child').'</li>';
    }

    public function getActiveChild($text, Nav $nav)
    {
        return '<li><a href="#">'.$text.' <span class="fa arrow"></span></a>'.$nav->setTemplate('sb-admin-2-child')->links('navigator::sb-admin-2-active-child').'</li>';
    }

}