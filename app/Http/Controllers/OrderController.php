<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use App\Address;
use Darryldecode\Cart;
use App\Meal;
use App\Menu;
use App\Notifications\OrderCreated;
use App\Option;
use App\OrderDetail;
// use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;
use Psy\Util\Json;
use Notification;
use App\Helpers\SmsService;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        $total = 0;
        $cartItems = \Cart::getContent();
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
        $addresses = null;
        $firstAdres = null;
        if ($user !== null) {
            $addresses = Address::where('user_id', $user->id)->get();
            if (count($addresses) > 0) {
                $firstAdres = $addresses[0];
            }
        }

        return view('frontend.orders.create', compact('cartItems', 'total', 'quantity', 'user', 'addresses', 'firstAdres'));
    }
    public function address(Address $address)
    {
        return $address;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = request()->validate([
            'address_name' => 'required',
            'city' => 'required',
            'address' => 'required',
            'contact_name' => 'required',
            'phone' => 'required',
            'email' => 'required'
        ]);

        // Restaurant::create($validated);

        //user kayıtlı değilse adres oluştur
        $user = auth()->user();
        $addressid = $request->address_id;
        if ($addressid == null || $addressid == '') {
            //adres oluştur
            $adres = Address::create($validated);
            $addressid = $adres->id;
            //user varsa usera set edelim
            if ($user !== null) {
                $adres->user_id = $addressid;
            }
        }
        $mevcutCart = \Cart::getContent();
        $first = $mevcutCart->first();
        $mevcutMenu = $first->attributes['menuid'];
        $menu = Menu::find($mevcutMenu);
        $restaurant_id = $menu->restaurant->id;
        $order = new Order();
        $order->restaurant_id = $restaurant_id;
        $order->menu_id = $menu->id;
        if ($user !== null) {
            $order->user_id = $user->id;
        }
        $order->address_id = $addressid;
        $order->notes = $request->notes;
        $order->orderno = "XYXTQ";
        $order->status = 1;
        $order->total = 0;
        $order->save();
        $total = 0;
        $quantity = 0;

        foreach ($mevcutCart as   $row) {
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
            $rowTotal = $base + $extfee + $opfee;
            $detail = new OrderDetail();
            $detail->order_id = $order->id;
            $detail->meal_id = $row->attributes['meal_id'];
            $detail->meal_name = $row->name;
            $detail->meal_price = $base;
            if ($row->attributes['option'] !== null) {
                $detail->option_id = $row->attributes['option']->id;
                $detail->option_name = $row->attributes['option']->option;
                $detail->option_price = $opfee;
            }
            $detail->quantity = $row->quantity;

            if ($row->attributes['extras'] !== null) {
                $detail->extras = json_encode($row->attributes['extras']);
                $detail->extras_price = $extfee;
            }
            $detail->sub_total = $rowTotal;
            $detail->discount = 0;
            $detail->total = $rowTotal;
            $detail->save();
        }
        $order->total = $total;
        $order->save();
        //sms
        //mail

        //sepeti temizle
        // \Cart::clear();

        \Notification::route('mail', $request->email)->notify(new OrderCreated($order, ''));

        \Notification::route('mail',  $order->restaurant->email)->notify(new OrderCreated($order, 'mudur'));

        $customerMessage = "Siparişiniz alındı. en kısa zamanda sipariş ettiğiniz lezzetlerle kapınızda olacağız. Afiyat olsun.";
        $mudurMessage = "Yeni sipariş alındı. sipariş linki: " . route('admin.orders.index', ['status' => 1]);
        $sms = new SmsService([$request->phone], $customerMessage);
        $sms->send();

        $smsMudur = new SmsService([$order->restaurant->phone], $mudurMessage);
        $smsMudur->send();
    }

    public function masaStore(Request $request, $masaid, $menuid)
    {
        //o masa için kapanmamış bir adisyon var mı bakacak
        //varsa o orderid için detail yazacak
        //orderı güncelleyecek
        $cartSession = $menuid . $masaid;
        $order = Order::where('kapandi', false)->where('masaid', $masaid)->first();
        $mevcutCart = \Cart::session($cartSession)->getContent();
        $first = $mevcutCart->first();
        $mevcutMenu = $first->attributes['menuid'];
        $menu = Menu::find($mevcutMenu);
        $restaurant_id = $menu->restaurant->id;
        // 
        if ($order == null) {
            $order = new Order();
            $order->restaurant_id = $restaurant_id;
            $order->menu_id = $menu->id;
            $order->orderno = "XYXTQ";
            $order->status = 1;
            $order->masaid = $masaid;
            $order->kapandi = false;
            $order->total = 0;
            $order->save();
        }

        $total = $order->total;


        $quantity = 0;

        foreach ($mevcutCart as   $row) {
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
            $rowTotal = $base + $extfee + $opfee;
            $detail = new OrderDetail();
            $detail->order_id = $order->id;
            $detail->meal_id = $row->attributes['meal_id'];
            $detail->meal_name = $row->name;
            $detail->meal_price = $base;
            $detail->goruldu = false;
            if ($row->attributes['option'] !== null) {
                $detail->option_id = $row->attributes['option']->id;
                $detail->option_name = $row->attributes['option']->option;
                $detail->option_price = $opfee;
            }
            $detail->quantity = $row->quantity;

            if ($row->attributes['extras'] !== null) {
                $detail->extras = json_encode($row->attributes['extras']);
                $detail->extras_price = $extfee;
            }
            $detail->sub_total = $rowTotal;
            $detail->discount = 0;
            $detail->total = $rowTotal;
            $detail->save();
        }
        $order->total = $total;
        $order->save();
        //sms
        //mail

        //sepeti temizle
        \Cart::session($cartSession)->clear();
        // \Notification::route('mail',  $order->restaurant->email)->notifyNow(new OrderCreated($order, 'mudur'));
        // \Notification::route('mail', $request->email)->notifyNow(new OrderCreated($order, ''));
        return 'başarılı';
        // dd($order);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}