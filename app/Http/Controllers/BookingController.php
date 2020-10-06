<?php

namespace App\Http\Controllers;

use App\Booking;
use Illuminate\Http\Request;
use App\Address;
use App\Restaurant;

use App\Helpers\SmsService;
use App\PageRestaurant;
use UxWeb\SweetAlert\SweetAlert;

class BookingController extends Controller
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
    public function create($id)
    {
        $paralax = PageRestaurant::first();
        $bookRestaurant = Restaurant::find($id);
        $user = auth()->user();
        $addresses = null;
        $firstAdres = null;
        if ($user !== null) {
            $addresses = Address::where('user_id', $user->id)->get();
            if (!$addresses->isEmpty()) {
                $firstAdres = $addresses[0];
            }
        }

        return view('frontend.bookings.create', compact('firstAdres',  'addresses', 'bookRestaurant', 'paralax'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $user = auth()->user();
        $user_id = null;
        if ($user != null) {
            $user_id = $user->id;
        }
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
        $date = \DateTime::createFromFormat('d/m/Y', $validated['date']);
        $time = \DateTime::createFromFormat('H:i:s', $validated['time']);
        $restaurant = Restaurant::find($validated['restaurant_id']);
        $gecerlimi = $restaurant->validateBookingTime($date, $time);
        if (!$gecerlimi) {
            alert()->error('Rezervasyon saatleri dışında rezervasyon yapamazsınız. Yan taraftaki açılış, kapanış saatelerine göre bilgilerinizi güncelleyip tekrar deneyiniz.')->persistent("Tamam");
            return redirect()->back();
        }
        $validated['date'] = $date;
        //timesa göre validayon
        //ayrıca rezervasyon sınırına göre validasyon
        //rezervasyon sınırını listede gösterelim.

        $validated['user_id'] = $user_id;

        $booking =   Booking::create($validated);

        $customerMessage = "Rezervasyon talebiniz alındı. Teşekkür ederiz..";
        $mudurMessage = "Yeni rezervasyon alındı: " . route('admin.bookings.index');
        $sms = new SmsService([$request->phone], $customerMessage);
        $sms->send();
        $restarauntPhone = $restaurant->phone;
        $smsMudur = new SmsService([$restarauntPhone], $mudurMessage);
        $smsMudur->send();
        alert('Rezervasyon talebiniz kaydedildi. Güzel vakit geçirmenizi diliyoruz.')->persistent("Tamam");
        return redirect()->route('restaurants.menu', ['restaurant' => $validated['restaurant_id']]);

        //success mesajı view ve mail, sms
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        return view('frontend.bookings.edit', compact('booking'));
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
        //müşteri rezervasyonu update yapabilecek mi?
        //müşteri panelinde rezervasyonlarım diye bir bölüm olursa update edebilir.
        //şimdilik böyle bir bölüm yok.
        $user = auth()->user();
        $user_id = null;
        if ($user != null) {
            $user_id = $user->id;
        }
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
        $validated['user_id'] = $user_id;

        $booking->update($validated);
        return 'başarılı';
        //success mesaj,

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }
}