<?php

namespace Decoweb\Panelpack;

use Illuminate\Support\ServiceProvider;
use Decoweb\Panelpack\TestController;
class PanelPackProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__.'/routes.php';
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
