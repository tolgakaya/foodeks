<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Helpers\CartService;

class HomeController extends Controller
{

    public function index()
    {
        $cartContent = CartService::cartContent();
        $cartItems = $cartContent['cartItems'];
        $total = $cartContent['total'];
        $quantity = $cartContent['quantity'];
        $restaurant = $cartContent['restaurant'];

        return view('frontend.home', compact('cartItems', 'total', 'quantity', 'restaurant'));
    }
}