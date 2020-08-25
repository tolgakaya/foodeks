<?php

namespace App\Http\Controllers\Admin;

use App\Booking;
use Illuminate\Http\Request;
use App\Address;
use App\Restaurant;
use App\Http\Controllers\Controller;
use App\Helpers\RoleConstant;
use App\User;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->role === RoleConstant::ROLE_ADMIN) {
            $bookings = Booking::all();
        } else {
            $bookings = Booking::where('restaurant_id', '=', $user->restaurant_id)->get();
        }

        return view('backend.bookings.index', compact('bookings'));
    }
    public function gunluk()
    {
        $date = new \DateTime();
        $date2 = $date->format('Y-m-d');

        $user = auth()->user();
        if ($user->role === RoleConstant::ROLE_ADMIN) {
            $bookings = Booking::where('date', $date2)->get();
        } else {
            $bookings = Booking::where('restaurant_id', '=', $user->restaurant_id)->where('date', $date2)->get();
        }

        return view('backend.bookings.index', compact('bookings'));
    }
    public function yarin()
    {
        $date = new \DateTime();
        $date->add(new \DateInterval('P1D'));

        $date2 = $date->format('Y-m-d');

        $user = auth()->user();
        if ($user->role === RoleConstant::ROLE_ADMIN) {
            $bookings = Booking::where('date', $date2)->get();
        } else {
            $bookings = Booking::where('restaurant_id', '=', $user->restaurant_id)->where('date', $date2)->get();
        }

        return view('backend.bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //restauranttan gelinmese de olur buraya
        $user = auth()->user();
        if ($user->role === RoleConstant::ROLE_ADMIN) {
            $restaurants = Restaurant::all();
        } else {
            $restaurants = Restaurant::where('id', '=', $user->restaurant_id)->get();
        }
        $users = User::where('role', '=', RoleConstant::ROLE_CUSTOMER)->with('restaurant')->get();
        //users da gönderilebilir, kolay rezervasyon için
        return view('backend.bookings.create', compact('restaurants', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //restauranttan gelindiğine göre
        // dd($request->all());
        $validated = request()->validate([
            'restaurant_id' => 'required',
            'date' => 'required',
            'time' => 'required',
            'quantity' => 'required',
            'notes' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required'
        ]);
        //user kayıtlıysa seçip gönderir, değilse anonim olarak kaydeder.

        $date = \DateTime::createFromFormat('d/m/Y', $validated['date']);
        $validated['date'] = $date;
        if (isset($request->user_id)) {
            $validated['user_id'] = $request->user_id;
        }

        $booking =   Booking::create($validated);
        return redirect(route('admin.bookings.index'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        // dd($booking);
        $user = auth()->user();
        if ($user->role === RoleConstant::ROLE_ADMIN) {
            $restaurants = Restaurant::all();
        } else {
            $restaurants = Restaurant::where('id', '=', $user->restaurant_id)->get();
        }
        $users = User::where('role', '=', RoleConstant::ROLE_CUSTOMER)->with('restaurant')->get();
        return view('backend.bookings.edit', compact('booking', 'users', 'restaurants'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //UPDATE'e status eklenecek
        $validated = request()->validate([
            'restaurant_id' => 'required',
            'date' => 'required',
            'time' => 'required',
            'quantity' => 'required',
            'notes' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required'
        ]);
        //user kayıtlıysa seçip gönderir, değilse anonim olarak kaydeder.

        $date = \DateTime::createFromFormat('d/m/Y', $validated['date']);
        $validated['date'] = $date;
        if (isset($request->user_id)) {
            $validated['user_id'] = $request->user_id;
        }

        $booking->update($validated);
        return redirect(route('admin.bookings.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //burada status iptal yapılabilir.
        $booking->status = 1;
        $booking->save();
        return redirect(route('admin.bookings.index'));
    }
}