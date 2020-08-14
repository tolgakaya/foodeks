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
        $cart = \Cart::getContent();
        return $cart;
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
        // return  $request->$extras;
        $mealid =  $request->mealid;
        $optionid = $request->optionid;
        $menuid = $request->menuid;

        if (!\Cart::isEmpty()) {
            $mevcutCart = \Cart::getContent();
            $first = $mevcutCart->first();
            $mevcutMenu = $first->attributes['menuid'];
            if ($menuid !== $mevcutMenu) {
                return ['message' => 'Aynı anda tek bir şubeden sipariş verebilirsiniz. Sepetinizi boşaltıp tekrar deneyiniz?', 'code' => 'mix'];
            }
        }

        $option = null;
        $rowid = $mealid;
        if ($optionid !== null) {
            $option = Option::find($optionid);
            $rowid = $mealid . $optionid;
        }
        $extras = null;;
        $extrasids = "";
        if ($request->extras !== null) {
            $extras = Extra::whereIn('id', $request->extras)->get();
            $extrasids = implode("-", $request->extras);
        }

        $rowid .= $extrasids;

        $meal = Meal::find($mealid);

        \Cart::add(array(
            'id' => $rowid,
            'name' => $meal->name,
            'price' => $request->fiyat,
            'quantity' => $request->miktar,
            'attributes' => ['meal_id' => $meal->id, 'option' => $option, 'extras' => $extras, 'menuid' => $menuid],
            'associatedModel' => $meal
        ));

        $total = 0;
        $cart = \Cart::getContent();
        $quantity = 0;
        foreach ($cart as   $row) {
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
        return ['cart' => $cart, 'total' => $total, 'quantity' => $quantity, 'code' => 'ok'];
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
    public function destroy(Request $request)
    {
        $rowid = $request->rowid;

        \Cart::remove($rowid);
        $total = 0;
        $cart = \Cart::getContent();
        $quantity = 0;
        foreach ($cart as   $row) {
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
        return ['cart' => $cart, 'total' => $total, 'quantity' => $quantity];
    }
}