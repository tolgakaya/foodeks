<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Restaurant;
use App\Category;
use Darryldecode\Cart;

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
        // dd($latitude, $longitude);
        // $restaurants = Restaurant::all();
        // $latitude = 36.896893;
        // $longitude = 30.713324;
        $restaurants = Restaurant::distance($latitude, $longitude)->orderBy('distance', 'asc')->get();
        // $restaurants = $query->orderBy('distance', 'asc')->get();
        // dd($restaurants);
        //belli bir yarı çaptakileri arama
        // $restaurants = Restaurant::geofence($latitude, $longitude, 0, 5)->orderBy('distance', 'ASC')->get();

        return view('frontend.restaurants.index', compact('restaurants', 'viewType'));
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
        $cartItems = \Cart::getContent();
        $total = 0;
        $quantity = 0;
        foreach ($cartItems as   $row) {
            $base = $row->quantity * $row->price;
            $quantity += $row->quantity;
            $opfee = 0;
            $extfee = 0;
            if ($row->attributes['option'] !== null) {
                $opfee = $row->attributes['option']->fee * $row->quantity;
            }
            if ($row->attributes['extras'] !== null) {
                foreach ($row->attributes['extras']  as $ext) {
                    $extfee += $ext->fee;
                }
            }
            $total += $base + $extfee + $opfee;
        }
        // dd($total);
        return view('frontend.restaurants.menu', compact('menu', 'meals', 'cartItems', 'total', 'quantity', 'restaurant'));
    }
}