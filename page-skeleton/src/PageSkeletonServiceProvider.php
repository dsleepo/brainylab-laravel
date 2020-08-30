<?php

namespace Brainylab\Laravel\PageSkeleton;

use Illuminate\Support\ServiceProvider;

class PageSkeletonServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'page-skeleton');

        $this->publishes([
            __DIR__ . '/config/page-skeleton.php' => config_path('page-skeleton.php'),
            __DIR__ . '/resources/views' => base_path('resources/views/vendor/page-skeleton')
        ]);


        $this->app->singleton('Brainylab\Laravel\PageSkeleton\PageSkeleton', function()
        {
            $instance = new PageSkeleton();
            $baseConfiguratorClass = config('page-skeleton.base_configurator');
            if ($baseConfiguratorClass)
            {
                app($baseConfiguratorClass)->configure($instance);
            }

            return $instance;
        });

        $app = $this->app;

        \Route::matched(function($route, $request) use ($app)
        {
            $app->extend('Brainylab\Laravel\PageSkeleton\PageSkeleton', function($page) use ($route, $request)
            {
                foreach (config('page-skeleton.configurators') as $configurator)
                {
                    app($configurator)->configure($page, $route, $request);
                }

                return $page;
            });
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

}