<?php
namespace Nurmanhabib\Navigator;

class Navigator {

    public $nav             = array();
    public $ulattr          = array('class' => 'nav navbar-nav navbar-right');
    public $liattr          = array('class' => '');
    public $liactive        = 'active';

    public $liparent_attr   = array('class' => 'parent');
    public $liparent_icon   = '<i class="fa fa-angle-left pull-right"></i>';
    public $liparent_active = 'active';

    public $child           = array();
    public $active          = '';

    public function __construct($navs = array(), $options = array(), $active = '')
    {
        $this->initialize($navs, $options, $active);
    }

    public function initialize($navs = array(), $options = array(), $active = '')
    {
        $this->nav      = $navs;
        $this->active   = $active;

        if(array_key_exists('ulattr', $options))
            $this->ulattr   = $options['ulattr'];

        if(array_key_exists('liattr', $options))
            $this->liattr   = $options['liattr'];
        
        if(array_key_exists('liactive', $options))
            $this->liactive = $options['liactive'];
        
        if(array_key_exists('liparent_attr', $options))
            $this->liparent_attr    = $options['liparent_attr'];
        
        if(array_key_exists('liparent_icon', $options))
            $this->liparent_icon    = $options['liparent_icon'];
        
        if(array_key_exists('liparent_active', $options))
            $this->liparent_active  = $options['liparent_active'];
        
        if(array_key_exists('child', $options))
            $this->child            = $options['child'];
    }

    public function set($navs)
    {
        $this->nav  = $navs;
    }

    public function add($navs)
    {
        $this->nav  += $navs;
    }

    public function set_active($link)
    {
        $this->active   = $link;
    }

    public function is_parent($active, $nav)
    {
        foreach ($nav as $link)
            if($link == $active)
                return true;
                return false;
    }

    private function generate_attr($attributes, $first_spacing = true)
    {
        $html   = '';

        foreach ($attributes as $attribute => $value)
        {
            if($html != '' || $first_spacing)
                $html   .= ' ';
                $html   .= $attribute . '="';

                if(!is_array($value))
                    $html   .= $value;

                $html   .= '"';
        }

        return $html;
    }

    public function generate($nav)
    {
        // Awalan
        $html   = '<ul' . $this->generate_attr($this->ulattr) . '>';

        // Listing
        foreach ($nav as $text => $link)
        {
            if(is_array($link))
            {
                // Dengan sub-listing               
                $navchild   = new Navigator($link, $this->child, $this->active);

                if($this->is_parent($this->active, $link))
                    $this->liparent_attr['class']   .= ' ' . $this->liparent_active;
                else
                    $this->liparent_attr['class']   = str_replace(' ' . $this->liparent_active, '', $this->liparent_attr['class']);

                $html   .= '<li' . $this->generate_attr($this->liparent_attr) . '>';            
                $html   .= '<a href="#">' . $text . $this->liparent_icon . '</a>';
                $html   .= $navchild->links();
                $html   .= '</li>';
            }
            else
            {
                // Tanpa sub-listing
                if($this->active == $link)
                    $this->liattr['class']  .= ' ' . $this->liactive;
                else
                    $this->liattr['class']  = str_replace(' ' . $this->liactive, '', $this->liattr['class']);

                $html   .= '<li' . $this->generate_attr($this->liattr) . '>';
                $html   .= '<a href="' . $link . '">' . $text . '</a>';
                $html   .= '</li>';
            }
        }

        // Akhiran
        $html   .= '</ul>';

        return $html;
    }

    public function links()
    {
        return $this->generate($this->nav);
    }

}
