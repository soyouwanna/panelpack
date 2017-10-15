<?php

namespace Decoweb\Panelpack\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        /*View::composer(
            'layouts.app', 'App\Http\ViewComposers\MenuComposer'
        );*/

        View::composer(
            '*', 'Decoweb\Panelpack\ViewComposers\SettingsComposer'
        );

        View::composer(
            'admin.layouts.master', 'Decoweb\Panelpack\ViewComposers\TablesMenuComposer'
        );

        View::composer(
            'admin.layouts.master', 'Decoweb\Panelpack\ViewComposers\NewOrdersComposer'
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
