<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Restaurant;
use App\PageRestaurant;
use App\Helpers\CartService;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $viewType = 'list')
    {
        $latitude = $request->input('address_latitude');
        $longitude = $request->input('address_longitude');
        $adres = $request->address_address;
        // dd($latitude, $longitude);
        // $restaurants = Restaurant::all();
        // $latitude = 36.896893;
        // $longitude = 30.713324;
        $restaurants = Restaurant::distance($latitude, $longitude)->orderBy('distance', 'asc')->paginate(10);
        // $restaurants = $query->orderBy('distance', 'asc')->get();
        // dd($restaurants);
        //belli bir yarı çaptakileri arama
        // $restaurants = Restaurant::geofence($latitude, $longitude, 0, 5)->orderBy('distance', 'ASC')->get();
        $page = PageRestaurant::first();

        return view('frontend.restaurants.index', compact('restaurants', 'viewType', 'page', 'adres'));
    }
    public function show(Restaurant $restaurant)
    {
        return view('frontend.restaurants.show', compact('restaurant'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function menu(Restaurant $restaurant)
    {
        $menu = $restaurant->menus()->with('meals', 'meals.options', 'meals.extras', 'meals.category')->first();

        $meals = $menu->meals()->where('pasif', 0)->get()->groupBy('category.category');

        $cartContent = CartService::cartContent();
        $cartItems = $cartContent['cartItems'];
        $total = $cartContent['total'];
        $quantity = $cartContent['quantity'];
        $page = PageRestaurant::first();
        return view('frontend.restaurants.menu', compact('menu', 'meals', 'cartItems', 'total', 'quantity', 'restaurant', 'page'));
    }
}