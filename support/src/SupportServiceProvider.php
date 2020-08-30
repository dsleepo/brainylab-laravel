<?php

namespace Brainylab\Laravel\Support;

use Illuminate\Support\ServiceProvider;

class SupportServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        require __DIR__ . "/helpers.php";
        require __DIR__ . "/validators.php";
    }

}