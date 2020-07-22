<?php

namespace App\Http\Controllers;

use App\Extra;
use Illuminate\Http\Request;
use Darryldecode\Cart;
use App\Meal;
use App\Option;
use Illuminate\Support\Str;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // \Cart::clear();
        $cart = \Cart::session(session('_token'))->getContent();
        return $cart;
        // // dd(session('_token'));
        // $m = Meal::find(1);
        // $rowid =   floor(time() - 999999999);
        // \Cart::session(session('_token'))->add(array(
        //     'id' => $rowid,
        //     'name' => $m->name,
        //     'price' => 10,
        //     'quantity' => 4,
        //     'attributes' => array(),
        //     'associatedModel' => $m
        // ));
        // $cartCollection = \Cart::getContent();
        // dd($cartCollection);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cartCollection = \Cart::session(session('_token'))->getContent();
        dd($cartCollection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // \Cart::session(sKCession('_token'))->clear();
        //meal_id
        //meal_adi
        //fiyat//
        //adet
        //seçenek
        //toplam
        //genel toplam
        //extralar=[adet, 'extra adi, fiyat]
        // return $request->all();
        $mealid =  $request->mealid;
        $optionid = $request->optionid;
        $option = null;
        if ($optionid !== null) {
            $option = Option::find($optionid);
        }
        $extras = null;;
        if ($request->extras !== null) {
            $extras = Extra::whereIn('id', $request->extras)->get();
        }
        $meal = Meal::find($mealid);
        $id = Str::random(9);
        \Cart::session(session('_token'))->add(array(
            'id' => $mealid,
            'name' => $meal->name,
            'price' => $request->fiyat,
            'quantity' => $request->miktar,
            'attributes' => array(['meal_id' => $meal->id, 'option' => $option, 'extras' => $extras]),
            'associatedModel' => $meal
        ));

        $cart = \Cart::session(session('_token'))->getContent();
        return $cart;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}