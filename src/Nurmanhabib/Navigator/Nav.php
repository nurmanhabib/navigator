<?php namespace Nurmanhabib\Navigator;

use Config;

class Nav {

    public $list;

    public $active;

    public $disabled;

    public $template;

    public function __construct($list = array(), $active = '', $disabled = array())
    {
        $this->initialize($list, $active, $disabled);
    }

    public function initialize($list = array(), $active = '', $disabled = array())
    {        
        $this->list     = $list;
        $this->active   = $active;
        $this->disabled = $disabled;

        $config         = Config::get('navigator::config');

        $this->setTemplate($config['template']);
    }

    public function setTemplate($name)
    {
        $template_alias     = Config::get('navigator::template');
        $template_class     = $template_alias[$name];

        $this->template     = new $template_class($this);

        return $this;
    }

    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    public function links($view = null)
    {
        $template_name = Config::get('navigator::config.template');
        $template_class = Config::get('navigator::template.'.$template_name);
        
        $template = new $template_class($this, $view);

        return $this->template->setView($view)->render();
    }

    public function __toString()
    {
        return (string) $this->links();
    }

}