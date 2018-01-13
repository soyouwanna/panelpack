<?php

namespace Decoweb\Panelpack\Providers;

use Illuminate\Support\ServiceProvider;
//use App\Product;
//use App\Category;
class ShopServiceProvider extends ServiceProvider
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
        $this->app->bind('Decoweb\Panelpack\Helpers\Contracts\ShopContract', function(){
//            return new \App\Helpers\Shop(new Category(), new Product());
            return new \Decoweb\Panelpack\Helpers\Shop();
        });

    }

    public function provides()
    {
        return ['Decoweb\Panelpack\Helpers\Contracts\ShopContract'];
    }
}
