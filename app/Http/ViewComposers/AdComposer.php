<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use  App\RestaurantAd;

class AdComposer
{
    public function __construct()
    {
    }

    public function compose(View $view)
    {
        $adds = RestaurantAd::first();
        $view->with(compact('adds'));
    }
}