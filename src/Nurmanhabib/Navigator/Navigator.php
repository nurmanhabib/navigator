<?php namespace Nurmanhabib\Navigator;

class Navigator {

    protected $navs;

    protected $current;

    public function __construct()
    {
        $this->navs = array();
        $this->current = array('name' => '', 'nav' => new Nav);
    }

    public function set($name, $list, $active = '', $disabled = array())
    {
        $nav = new Nav($list, $active, $disabled);

        $this->navs[$name]  = $nav;
        $this->current      = array('name' => $name, 'nav' => $nav);

        return $nav;
    }

    public function setDefault($list, $active = '', $disabled = array())
    {
        return $this->set('default', $list, $active, $disabled);
    }

    public function name($name)
    {
        if (array_key_exists($name, $this->navs)) {
            $nav            = $this->navs[$name];
            $this->current  = array('name' => $name, 'nav' => $nav);
            
            return $nav;
        }
        else
            return new Nav;
    }

    public function __set($name, Nav $nav)
    {
        $this->nav[$name]   = $nav;
        $this->current      = array('name' => $name, 'nav' => $nav);
    }

    public function __get($name)
    {
        $nav = array_key_exists($name, $this->navs) ? $this->navs[$name] : new Nav;
        
        return $nav;
    }

    public function __toString()
    {
        return (string) $this->current['nav'];
    }

}