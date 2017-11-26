<?php

namespace Decoweb\Panelpack\Providers;

use Illuminate\Support\ServiceProvider;
use Decoweb\Panelpack\Helpers\Magazin;
use App\Category;
use App\Product;
class MagazinServiceProvider extends ServiceProvider
{
    protected $defer = true;
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Decoweb\Panelpack\Helpers\Contracts\MagazinContract', function(){

            return new Magazin(new Category(),new Product());

        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['Decoweb\Panelpack\Helpers\Contracts\MagazinContract'];
    }
}
