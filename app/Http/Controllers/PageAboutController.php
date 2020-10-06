<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PageAbout;
use App\PageAboutGallery;
use App\Restaurant;
use App\PageRestaurant;
use App\PageSettings;

class PageAboutController extends Controller
{
    public function index()
    {
        $page = PageAbout::first();
        $medias = PageAboutGallery::all();
        $bookRestaurant = Restaurant::first();
        $paralax = PageRestaurant::first();
        $settings = PageSettings::first();
        return view('frontend.about', compact('page', 'medias', 'bookRestaurant', 'settings', 'paralax'));
    }
}