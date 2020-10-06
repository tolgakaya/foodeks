<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PageHome;
use App\Restaurant;

class HomeController extends Controller
{

    public function index()
    {
        $page = PageHome::first();
        $restaurants = null;
        if ($page == null || $page->restaurant_list_show) {
            $restaurants = Restaurant::take(6)->get();
        }


        return view('frontend.home', compact('page', 'restaurants'));
    }
}