<?php

namespace Decoweb\Panelpack;

use Illuminate\Support\ServiceProvider;
class PanelPackProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');

        $this->publishes([
            __DIR__.'/assets' => public_path('/assets'),
        ], 'assets');

        $this->publishes([
            __DIR__.'/Mail' => app_path('/Mail'),
        ], 'mail');

        $this->publishes([
            __DIR__.'/Notifications' => app_path('/Notifications'),
        ], 'notifications');

        $this->publishes([
            __DIR__.'/ViewComposers/MenuComposer.php' => app_path('Http/ViewComposers/MenuComposer.php'),
        ], 'menu');

        $this->publishes([
            __DIR__.'/config/settings.php' => config_path('settings.php'),
        ], 'config');
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
