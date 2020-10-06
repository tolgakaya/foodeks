<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use  App\Helpers\CartService;

class CartComposer
{
    public function __construct()
    {
    }

    public function compose(View $view)
    {
        $cartContent = CartService::cartContent();
        $cartItems = $cartContent['cartItems'];
        $total = $cartContent['total'];
        $quantity = $cartContent['quantity'];
        $restaurant = $cartContent['restaurant'];

        $view->with(['cartItems' => $cartItems, 'total' => $total, 'quantity' => $quantity, 'restaurant' => $restaurant]);
    }
}