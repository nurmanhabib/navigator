<?php namespace Nurmanhabib\Navigator;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class NavigatorServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('nurmanhabib/navigator');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('navigator', function($app)
        {
            return new Navigator;
        });

        $this->app->bind('navitem', function()
        {
            return new Nav;
        });

        $this->app->booting(function()
        {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Navigator', 'Nurmanhabib\Navigator\Facades\Navigator');
        })
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

}
