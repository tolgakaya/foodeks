<?php

namespace App\Helpers;

use App\Restaurant;
use Darryldecode\Cart;
use App\Menu;

class CartService
{

    public static function cartContent()
    {
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
        $first = $cartItems->first();
        $restaurant = null;
        if ($first !== null) {
            $mevcutMenu = $first->attributes['menuid'];
            $menu = Menu::find($mevcutMenu);
            $restaurant_id = $menu->restaurant->id;
            $restaurant = Restaurant::find($restaurant_id);
        }


        return ['cartItems' => $cartItems, 'total' => $total, 'quantity' => $quantity, 'restaurant' => $restaurant];
    }
}