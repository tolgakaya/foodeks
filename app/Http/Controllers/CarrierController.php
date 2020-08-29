<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\RoleConstant;
use App\User;
use App\Restaurant;
use App\Order;
use App\OrderDetail;
use Validator;
use App\Address;
use App\Menu;
use App\Meal;
use App\Option;
use App\MealMenu;
use App\Extra;
use App\OrderUser;

class CarrierController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index($status = 'all')
    {

        $user = auth()->user();
        if ($user->role === RoleConstant::ROLE_CARRIER) {

            $orders = $user->paketciOrders()->where('status', 3)->with('address')->orderByDesc('updated_at')->paginate(20);
        }
        return view('backend.orders.carrier', compact('orders'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request, Order $order)
    {
        $user = auth()->user();
        $validated = request()->validate([
            'orderid' => 'required',
            'status' => 'required'
        ]);
        $status = $request->status;
        if ($status == 'iptal') {
            $order->status = 5;
        } else if ($status == 'teslim') {
            $order->status = 4;
        }
        $order->save();
        $task = OrderUser::where('order_id', $order->id)->where('user_id', $user->id)->first();
        $date = new \DateTime();
        $saat = $date->format('H:i:s');
        $task->end_time = $saat;
        $task->save();
        return  ['message' => "ok"];
    }
    public function qr(Order $order)
    {
        $user = auth()->user();

        $date = new \DateTime();
        $tarih = $date->format('Y-m-d');
        $saat = $date->format('H:i:s');

        $order->carriers()->attach($$user->id, ['restaurant_id' => $order->restaurant->id, 'order_id' => $order->id, 'begin_date' => $tarih, 'begin_time' => $saat]);
        $order->status = 3;

        $order->save();
        return redirect()->route('carrier.dashboard');
    }
    public function addshow(Order $order)
    {
        // dd($restaurant);
        return view('backend.orders.harita', compact('order'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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