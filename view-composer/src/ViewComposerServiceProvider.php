<?php

namespace Brainylab\Laravel\ViewComposer;

use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/view-composers.php' => config_path('view-composers.php')
        ]);

        foreach (config('view-composers.always', []) as $value )
        {
            view()->composer(
                '*', $value
            );
        }

        foreach (config('view-composers.providers', []) as $key => $value )
        {
            view()->composer(
                $key, $value
            );
        }
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