<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PageRestaurant;
use App\PageSettings;
use App\Booking;
use App\Order;
use App\Rules\MatchOldPassword;
use App\Rules\MatchOldEmail;
use App\User;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $bookings = Booking::where('user_id', $user->id)->get();
        $userOrders = Order::where('user_id', $user->id)->with('orderdetails')->orderByDesc('created_at')->get();

        $paralax = PageRestaurant::first();
        $settings = PageSettings::first();
        return view('frontend.profiles.index', compact('paralax', 'settings', 'bookings', 'userOrders'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);
        alert('Şifreniz başarı ile değiştirildi. Güzel vakit geçirmenizi diliyoruz.')->persistent("Tamam");
        return redirect()->route('customer.profile.index');
    }

    public function emailUpdate(Request $request)
    {
        $request->validate([
            'old_email' => ['required', new MatchOldEmail],
            'new_email' => ['required'],
            'confirm_new_email' => ['same:new_email'],
        ]);
        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);
        alert('Emailiniz başarı ile değiştirildi. Güzel vakit geçirmenizi diliyoruz.')->persistent("Tamam");
        return redirect()->route('customer.profile.index');
    }
}