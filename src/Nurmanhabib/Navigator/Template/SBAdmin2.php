<?php namespace Nurmanhabib\Navigator\Template;

class SBAdmin2 extends Template {

    protected $view = 'navigator::sb-admin-2';

    public function getActiveItem($text, $url)
    {
        return '<li><a href="'.$url.'" class="active">'.$text.'</a></li>';
    }

}