<?php namespace Nurmanhabib\Navigator;

class Navigator {

    protected $app;
    protected $config;

    protected $name;
    protected $collections;
    protected $active;

    public function __construct($app)
    {
        $this->app          = $app;
        $this->config       = $app->config;

        $this->name         = 'default';
        $this->collections  = ['default' => new NavCollection];
        $this->active       = $this->app->url->full();
    }

    public function set($text, $url = '#', $icon = 'dashboard')
    {
        return $this->collections[$this->name]->set($text, $url, $icon);
    }

    public function current()
    {
        $name       = $this->name;
        $current    = array_get($this->collections, $name, new NavCollection);

        return $current;
    }

    public function show($name = '')
    {
        if ($name) $this->setCurrent($name);

        return $this->collections[$this->name];
    }

    public function name($name)
    {
        if (!array_key_exists($name, $this->collections))
            $this->collections[$name] = new NavCollection;
            $this->setCurrent($name);

            return $this;
    }

    public function setCurrent($name, NavCollection $collection = null)
    {
        $this->name = $name;
        $collection = $collection ?: array_get($this->collections, $name, new NavCollection);
        $collection->setActive($this->active);

        return $collection;
    }

    public function setActive($url)
    {
        $this->collections[$this->name]->setActive($url);
    }

    public function setTemplate($name)
    {
        $this->collections[$this->name]->setTemplate($name);
    }

    public function __set($name, NavCollection $collection)
    {
        $this->collections[$name]   = $collection;
        $this->setCurrent($name, $collection);
    }

    public function __get($name)
    {
        $collection = array_key_exists($name, $this->collections) ? $this->collections[$name] : new NavCollection;
        
        return $collection;
    }
    
    public function __toString()
    {
        return (string) $this->current['nav'];
    }

}
