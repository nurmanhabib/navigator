<?php

namespace Nurmanhabib\Navigator;

use Illuminate\Support\ServiceProvider;

class NavigatorServiceProvider extends ServiceProvider
{

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	public function boot()
	{
	    $this->loadViewsFrom(__DIR__ . '/../views/template', 'navigator');
	    $this->loadViewsFrom(base_path('resources/views/vendor/navigator/template'), 'mynavigator');

	    $this->publishes([
	    	__DIR__ . '/../views/template' => base_path('resources/views/vendor/navigator/template'),
	    ]);
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
			return new Navigator($app);
		});

        $this->app->booting(function()
        {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Navigator', 'Nurmanhabib\Navigator\Facades\Navigator');
        });
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [];
	}

}
