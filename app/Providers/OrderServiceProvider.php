<?php

namespace App\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use App\Services\OrderService;
use App\Facades\Order as OrderFacade;

/**
 * Class OrderServiceProvider
 * @package App\Providers
 */
class OrderServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('order', function($app)
        {
            return new OrderService();
        });
        AliasLoader::getInstance()->alias('Order', OrderFacade::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
