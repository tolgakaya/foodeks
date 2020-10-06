<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\PageSettings;

class StyleComposer
{
    public function __construct()
    {
    }

    public function compose(View $view)
    {
        $settings = PageSettings::first();
        $view->with(['settings' => $settings]);
    }
}