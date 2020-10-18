<?php

namespace Rafadepaula\Tools;

use Illuminate\Support\ServiceProvider;

class ToolsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
		$this->loadViewsFrom(__DIR__.'/components', 'rafadepaula');
		$this->publishes([
			__DIR__.'/views' => resource_path('views'),
			__DIR__.'/Controllers' => app_path('Http/Controllers'),
			__DIR__.'/Models' => app_path('Models'),
			__DIR__.'/Requests' => app_path('Http/Requests'),
		]);
		$this->publishes([
			__DIR__.'/assets' => public_path(),
		], 'public');
		$this->publishes(([
			__DIR__.'/config/menu.php' => config_path('menu.php'),
		]));
    }
}
