<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\ViewComposers\FooterComposer;
use App\Http\ViewComposers\CartComposer;
use App\Http\ViewComposers\StyleComposer;
use App\Http\ViewComposers\AdComposer;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(
            'frontend.layouts.layout',
            FooterComposer::class
        );
        view()->composer(
            'frontend.restaurant.index',
            AdComposer::class
        );
        view()->composer(
            'backend.layouts.main',
            FooterComposer::class
        );
        view()->composer(
            'backend.layouts.touchlessmain',
            FooterComposer::class
        );
        view()->composer(
            'frontend.layouts.layout',
            CartComposer::class
        );
        view()->composer(
            'frontend.restaurants.sidecart',
            CartComposer::class
        );
        view()->composer(
            'frontend.layouts.layout',
            StyleComposer::class
        );
    }
}