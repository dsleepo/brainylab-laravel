<?php

namespace Brainylab\Laravel\RobotsTxt;

use Illuminate\Support\ServiceProvider;

class RobotsTxtServiceProvider extends ServiceProvider {

	public function boot()
    {
    	if (! $this->app->routesAreCached()) 
    	{
        	require __DIR__.'/routes.php';
    	}
    }

    public function register()
    {
    	// 
    }

}