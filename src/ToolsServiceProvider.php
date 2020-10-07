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
		$this->loadViewsFrom(__DIR__.'/views', 'rafadepaula');
		$this->publishes([
			__DIR__.'/views' => resource_path('views'),
			__DIR__.'/Controllers' => app_path('Http/Controllers'),
			__DIR__.'/Models' => app_path('Models'),
		]);
		$this->publishes([
			__DIR__.'/assets' => public_path(),
		], 'public');
    }
}
