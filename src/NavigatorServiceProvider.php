<?php namespace Nurmanhabib\Navigator;

use Illuminate\Support\ServiceProvider;

class NavigatorServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->bind('navigator', function()
        {
            return new Navigator;
        });

        $this->app->booting(function()
        {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Navigator', 'Nurmanhabib\Navigator\Facades\Navigator');
        });
    }

}