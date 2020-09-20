<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\CardService;

/**
 * Class CardServiceProvider
 * @package App\Providers
 */
class CardServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('card', function($app)
        {
            return new CardService($app['config']['card']);
        });
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
