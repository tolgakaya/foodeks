<?php

namespace App\Http\Controllers\Admin;

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
use App\Notifications\OrderCreated;
use Notification;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index($status = 'all')
    {
        //günlük orders
        //active orders
        //günlük active orders
        //status-created, üretildi, yolda, teslim edildi, iptal edildi, iptal
        $user = auth()->user();
        if ($user->role === RoleConstant::ROLE_ADMIN) {
            $users = User::where('role', RoleConstant::ROLE_CARRIER)->get();
            $restaurants = Restaurant::all();
            if ($status == 'all') {

                $orders = Order::where('masaid', null)->with('orderdetails')->orderByDesc('updated_at')->paginate(20);
            } else {
                $orders = Order::where('masaid', null)->with('orderdetails')->where('status', $status)->orderByDesc('updated_at')->paginate(20);
            }
        } else {
            $users = User::where('role', RoleConstant::ROLE_CARRIER)
                ->where('restaurant_id', '=', $user->restaurant_id)
                ->get();
            $restaurants = Restaurant::where('id', '=', $user->restaurant_id)->get();
            if ($status == 'all') {
                $orders = Order::where('restaurant_id', '=', $user->restaurant_id)->where('masaid', null)->with('orderdetails', 'address')->orderByDesc('updated_at')->paginate(20);
            } else {
                $orders = Order::where('restaurant_id', '=', $user->restaurant_id)->where('masaid', null)->where('status', $status)->with('orderdetails')->orderByDesc('updated_at')->paginate(20);
            }
        }
        return view('backend.orders.index', compact('orders', 'users', 'restaurants'));
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function indexMasa($status = null)
    {
        //günlük orders
        //active orders
        //günlük active orders
        //status-created, üretildi, yolda, teslim edildi, iptal edildi, iptal
        $user = auth()->user();
        if ($user->role === RoleConstant::ROLE_ADMIN) {
            $users = User::where('role', RoleConstant::ROLE_CARRIER)->get();
            $restaurants = Restaurant::all();
            if ($status == null) {

                $orders = Order::where('masaid', '!=', null)->where('kapandi', '!=', true)->with('orderdetails')->orderByDesc('updated_at')->paginate(20);
            } else {
                $orders = Order::where('masaid', '!=', null)->where('kapandi', '!=', true)->with('orderdetails')->where('status', $status)->orderByDesc('updated_at')->paginate(20);
            }
        } else {
            $users = User::where('role', RoleConstant::ROLE_CARRIER)
                ->where('restaurant_id', '=', $user->restaurant_id)
                ->get();
            $restaurants = Restaurant::where('id', '=', $user->restaurant_id)->get();
            if ($status == 'all') {
                $orders = Order::where('restaurant_id', '=', $user->restaurant_id)->where('kapandi', '!=', true)->where('masaid', '!=', null)->with('orderdetails', 'address')->orderByDesc('updated_at')->paginate(20);
            } else {
                $orders = Order::where('restaurant_id', '=', $user->restaurant_id)->where('masaid', '!=', true)->where('kapandi', '!=', null)->where('status', $status)->with('orderdetails')->orderByDesc('updated_at')->paginate(20);
            }
        }
        return view('backend.orders.adisyons', compact('orders', 'users', 'restaurants'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * Admin restaurant listesinde gelerek sipariş oluşturacak
     * diğer müdürler sadece kendi restaurantlarından gelerek sipariş oluşturacaklar
     */
    public function create(Restaurant $restaurant)
    {
        ///en iyisi restaurantsı indexe atıp oradan restaurantla gelelim.
        $menu = $restaurant->menus()->with('meals', 'meals.options', 'meals.extras', 'meals.category')->first();
        $user = auth()->user();
        if ($user->role === RoleConstant::ROLE_ADMIN) {
            $users = User::where('role', RoleConstant::ROLE_CUSTOMER)->get();
            $restaurants = Restaurant::all();
        } else {
            $users = User::where('role', RoleConstant::ROLE_CUSTOMER)
                ->where('restaurant_id', '=', $user->restaurant_id)
                ->get();
            $restaurants = Restaurant::where('id', '=', $user->restaurant_id)->get();
        }
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
        return view('backend.orders.create', compact('restaurants', 'menu', 'cartItems', 'quantity', 'total', 'users'));
    }
    public function addresses(User $user)
    {
        $addresses = $user->addresses()->get();
        return response()->json(compact('addresses'));
    }

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

        $addressid = $request->address_id;
        if ($addressid == null || $addressid == '') {
            //adres oluştur
            $adres = Address::create($validated);
            $addressid = $adres->id;
            //user varsa usera set edelim
            // if ($user !== null) {
            //     $adres->user_id = $addressid;
            // }
        }
        $mevcutCart = \Cart::getContent();
        $first = $mevcutCart->first();
        $mevcutMenu = $first->attributes['menuid'];
        $menu = Menu::find($mevcutMenu);
        $restaurant_id = $menu->restaurant->id;
        $order = new Order();
        $order->restaurant_id = $restaurant_id;
        $order->menu_id = $menu->id;
        if ($request->userid !== null) {
            $order->user_id = $request->userid;
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
        \Cart::clear();
        \Notification::route('mail',  $order->restaurant->email)->notifyNow(new OrderCreated($order, 'mudur'));
        \Notification::route('mail', $request->email)->notifyNow(new OrderCreated($order, ''));
        return 'başarılı';
        // dd($order);

    }


    public function mealDetails(Meal $meal)
    {
        $options = $meal->options;
        $extras = $meal->extras;
        return response()->json(compact('options', 'extras'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function goruldu(Order $order)
    {
        $details = $order->orderdetails()->where('goruldu', '!=', true)->get();
        if ($details != null) {
            foreach ($details as  $detail) {
                $detail->goruldu = true;
                $detail->save();
            }
        }
        return redirect()->route('admin.orders.indexMasa');
    }

    public function kapat(Order $order)
    {
        $order->kapandi = true;
        $order->save();
        return redirect()->route('admin.orders.indexMasa');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $user = auth()->user();
        if ($user->role === RoleConstant::ROLE_ADMIN) {
            $users = User::where('role', RoleConstant::ROLE_CUSTOMER)->get();
            $restaurants = Restaurant::all();
        } else {
            $users = User::where('role', RoleConstant::ROLE_CUSTOMER)
                ->where('restaurant_id', '=', $user->restaurant_id)
                ->get();
            $restaurants = Restaurant::where('id', '=', $user->restaurant_id)->get();
        }
        $bisey = $order->with('orderdetails')->first();
        // dd($bisey->orderdetails);
        $addresid = $bisey->address_id;
        $addresimiz = $bisey->address;

        return view('backend.orders.edit', ['order' => $order, 'users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        if ($order->masaid == null) {
            $validated = request()->validate([
                'address_name' => 'required',
                'city' => 'required',
                'address' => 'required',
                'contact_name' => 'required',
                'phone' => 'required',
                'email' => 'required'
            ]);

            $addressid = $request->address_id;
            if ($addressid == null || $addressid == '') {
                $adres = Address::create($validated);
                $addressid = $adres->id;
                $order->address_id = $addressid;
            }
        }
        return back();
    }

    public function statusUpdate(Request $request)
    {
        // return $request->all();
        $ids = $request->orders;
        // return $ids;
        if ($ids != null) {
            $orders = Order::whereIn('id', $ids)->get();
            if ($orders !== null) {
                foreach ($orders as   $order) {
                    $order->status = $request->status;
                    $order->save();
                }
                return $orders;
            }
        }

        // return redirect('admin.orders.index', ['status' => $request->status]);
    }

    public function taskStore(Request $request)
    {
        $rules = [
            'orderids.*' => 'unique:order_user,order_id',
            'userid' => 'required',
        ];

        $customMessages = [
            'required' => 'The :attribute field can not be blank.',
            'orderids.*.unique' => 'Seçilen siparişlerden birisi yolda görülüyor.'
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages);
        // $this->validate($request, $rules, $customMessages);
        if ($validator->passes()) {
            $orderids = $request->orderids;
            $paketciId = $request->userid;

            $date = new \DateTime();
            $tarih = $date->format('Y-m-d');
            $saat = $date->format('H:i:s');
            if ($orderids != null) {

                $orders = Order::whereIn('id', $orderids)->get();
                if ($orders !== null) {
                    foreach ($orders as   $order) {

                        $order->carriers()->attach($paketciId, ['restaurant_id' => $order->restaurant->id, 'order_id' => $order->id, 'begin_date' => $tarih, 'begin_time' => $saat]);
                        $order->status = 3;

                        $order->save();
                    }
                    return $orders;
                }
            }
        }
        return response()->json(['error' => 'Seçili sipariş çoktan yola çıkmış görünüyor']);



        // return redirect('admin.orders.index', ['status' => $request->status]);
    }

    // public function taskStore(Request $request)
    // {
    //     $rules = [
    //         'orderids.*' => 'unique:tasks,order_id',
    //         'userid' => 'required',
    //     ];

    //     $customMessages = [
    //         'required' => 'The :attribute field can not be blank.',
    //         'orderids.*.unique' => 'Seçilen siparişlerden birisi yolda görülüyor.'
    //     ];
    //     $validator = Validator::make($request->all(), $rules, $customMessages);
    //     // $this->validate($request, $rules, $customMessages);
    //     if ($validator->passes()) {
    //         $orderids = $request->orderids;
    //         $paketciId = $request->userid;

    //         $date = new \DateTime();
    //         $tarih = $date->format('Y-m-d');
    //         $saat = $date->format('H:i:s');
    //         if ($orderids != null) {

    //             $orders = Order::whereIn('id', $orderids)->get();
    //             if ($orders !== null) {
    //                 foreach ($orders as   $order) {

    //                     $task = [
    //                         'restaurant_id' => $order->restaurant_id,
    //                         'order_id' => $order->id,
    //                         'user_id' => $paketciId,
    //                         'begin_date' => $tarih,
    //                         'begin_time' => $saat
    //                     ];
    //                     $order->task()->create($task);
    //                     $order->status = 3;

    //                     $order->save();
    //                 }
    //                 return $orders;
    //             }
    //         }
    //     }
    //     return response()->json(['error' => 'Seçili sipariş çoktan yola çıkmış görünüyor']);



    //     // return redirect('admin.orders.index', ['status' => $request->status]);
    // }

    public function detailDelete(Request $request)
    {
        request()->validate(['detailid' => 'required']);
        $detail = OrderDetail::find($request->detailid);
        $detail->delete();
        return ['message' => 'ok'];
    }
    public function detailUpdate(Request $request)
    {
        $validated = request()->validate([
            'orderid' => 'required',
            'mealid' => 'required',
            'quantity' => 'required',
            'optionid' => 'required',
            'extras' => 'required',
            'menuid' => 'required'
        ]);
        //orderdetail kelendiktensonra order totalini güncelle

        $meal = Meal::find($request->mealid);
        $menu = Menu::find($request->menuid);
        $order = Order::find($request->orderid);
        $option = Option::find($request->optionid);

        $meal_price = MealMenu::where(['menu_id' => $menu->id, 'meal_id' => $meal->id])->firstOrFail()->fee;

        $detail = new OrderDetail();
        $detail->order_id = $order->id;
        $detail->meal_id = $meal->id;
        $detail->meal_name = $meal->name;
        $detail->meal_price = $meal_price;
        $detail->quantity = $request->quantity;
        $detail->option_id = $option->id;
        $detail->option_name = $option->option;
        $detail->option_price = $option->fee;
        $extFee = 0;
        if ($request->extras !== null) {
            $extras = Extra::whereIn('id', $request->extras)->get();
            foreach ($extras as $extra) {
                $extFee += $extra->fee;
            }
            $detail->extras = json_encode($extras);
        }
        $detail->extras_price = $extFee;
        $detail->sub_total = 0;
        $detail->discount = 0;
        $total = ($request->quantity) * ($meal_price + $option->fee + $extFee);
        $detail->total = $total;
        $detail->save();
        $order->total = $total;
        $order->save();

        $orderWithDetails = $order->orderdetails;

        return response()->json(compact('orderWithDetails'));
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