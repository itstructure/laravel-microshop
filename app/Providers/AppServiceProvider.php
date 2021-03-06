<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\View\Composers\{CategoryViewComposer, TopCardViewComposer, OrderCardViewComposer};

/**
 * Class AppServiceProvider
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        View::composer(
            ['home', 'product'],
            TopCardViewComposer::class
        );

        View::composer(
            ['card'],
            OrderCardViewComposer::class
        );

        View::composer(
            ['home', 'card', 'product'],
            CategoryViewComposer::class
        );
    }
}
