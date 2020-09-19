<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\RoleConstant as HelpersRoleConstant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Restaurant;
use App\User;
use App\Helpers\RoleConstant;
use UxWeb\SweetAlert\SweetAlert;
use Darryldecode\Cart;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($viewType = 'list')
    {
        // $restaurants = Restaurant::all();
        $latitude = 36.896893;
        $longitude = 30.713324;
        $user = auth()->user();
        if ($user->role === RoleConstant::ROLE_ADMIN) {
            $restaurants = Restaurant::distance($latitude, $longitude)->orderBy('distance', 'asc')->get();
        } else {
            $restaurants = Restaurant::where('id', '=', $user->restaurant_id)->get();
        }
        return view('backend.restaurant.index', compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $restaurant = new Restaurant();
        return view('backend.restaurant.create');
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
            'name' => 'required',
            'description' => 'required',
            'coordinate' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required'
        ]);

        Restaurant::create($validated);
        alert()->success('Yeni restaurant başarı ile kaydedildi', 'Kayıt Başarılı');
        return redirect()->route('admin.restaurant.index');
    }

    public function assign(Restaurant $restaurant)
    {
        $validated = request()->validate([
            'userid' => 'required',
        ]);
        $user = User::find($validated['userid']);
        $user->restaurant_id = $restaurant->id;
        $user->save();
        return $restaurant->users()->get();
    }

    public function unsign(Restaurant $restaurant)
    {
        $validated = request()->validate([
            'userid' => 'required',
        ]);
        $user = User::find($validated['userid']);

        $user->restaurant_id = null;
        $user->save();
        return $restaurant->users()->get();
    }
    public function users(Restaurant $restaurant)
    {
        return User::where('role', '>', RoleConstant::ROLE_CUSTOMER)->where('restaurant_id', null)->get();
    }
    public function staffs(Restaurant $restaurant)
    {
        return view('backend.restaurant.stafs', compact('restaurant'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        // dd($restaurant);
        return view('backend.restaurant.edit', compact('restaurant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        $validated = request()->validate([
            'name' => 'required',
            'description' => 'required',
            'coordinate' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ]);


        $restaurant->update($validated);
        // Restaurant::create($validated);
        return redirect()->route('admin.restaurant.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        //
    }
    public function distances()
    {
        $latitude = 36.896893;
        $longitude = 30.713324;
        $query = Restaurant::distance($latitude, $longitude);
        // Model::select('id', 'name')->distance($latitude, $longitude);
        $asc = $query->orderBy('distance', 'ASC')->get();
        return $asc;
    }
}