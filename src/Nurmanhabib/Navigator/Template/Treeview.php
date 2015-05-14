<?php namespace Nurmanhabib\Navigator\Template;

use Nurmanhabib\Navigator\Nav;

class Treeview extends Template {

    protected $view = 'navigator::treeview';

    public function getChild($text, Nav $nav)
    {
        return '<li class="treeview"><a href="">'.$text.' <i class="fa fa-angle-left pull-right"></i></a>'.$nav->setTemplate('treeview-child').'</li>';
    }

    public function getActiveChild($text, Nav $nav)
    {
        return '<li class="treeview active"><a href="">'.$text.' <i class="fa fa-angle-left pull-right"></i></a>'.$nav->setTemplate('treeview-child')->setView('navigator::treeview-active-child').'</li>';
    }

}