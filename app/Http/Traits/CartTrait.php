<?php

namespace App\Http\Traits;

use  App\Helpers\CartService;
use App\Http\Traits\FooterTrait;
use App\PageHome;
use App\PageSettings;
use App\Restaurant;

trait CartTrait
{
    public function index()
    {
        $cartContent = CartService::cartContent();
        $cartItems = $cartContent['cartItems'];
        $total = $cartContent['total'];
        $quantity = $cartContent['quantity'];
        $restaurant = $cartContent['restaurant'];

        return view('frontend.Cart.index')->with(compact('cartItems', 'total', 'quantity', 'restaurant'));
    }
}