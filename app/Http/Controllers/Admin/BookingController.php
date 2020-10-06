<?php

namespace App\Http\Controllers\Admin;

use App\Booking;
use Illuminate\Http\Request;
use App\Address;
use App\Http\Controllers\Controller;
use App\Helpers\RoleConstant;
use App\Event;
use Redirect, Response;
use App\User;
use App\Restaurant;
use UxWeb\SweetAlert\SweetAlert;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        if ($user->role === RoleConstant::ROLE_ADMIN) {
            $bookings = Booking::all();
        } else {
            $bookings = Booking::where('restaurant_id', '=', $user->restaurant_id)->get();
        }
        if ($request->ajax()) {
            return response()->json($bookings);
        }
        return view('backend.bookings.index', compact('bookings'));
    }
    public function cali(Request $request)
    {
        $user = auth()->user();
        if ($user->role === RoleConstant::ROLE_ADMIN) {
            $bookings = Booking::all();
        } else {
            $bookings = Booking::where('restaurant_id', '=', $user->restaurant_id)->get();
        }
        $events = [];
        foreach ($bookings as $book) {
            $events[] = ['title' => $book->name, 'start' => $book->date];
        }
        return response()->json($events);
    }

    private function random_color_part()
    {
        $dt = '';
        for ($o = 1; $o <= 3; $o++) {
            $dt .= str_pad(dechex(mt_rand(0, 127)), 2, '0', STR_PAD_LEFT);
        }
        return $dt;
    }

    public function calendar(Request $request)
    {
        $user = auth()->user();
        if ($user->role === RoleConstant::ROLE_ADMIN) {
            $bookings = Booking::where('status', 0)->get();
        } else {
            $bookings = Booking::where('restaurant_id', '=', $user->restaurant_id)->where('status', 0)->get();
        }
        $events = [];
        foreach ($bookings as $book) {
            // $bas = \DateTime::createFromFormat('Y-m-d H:i:s', $book->date);
            $bas = date('Y-m-d H:i:s', strtotime("$book->date $book->time"));
            $ort = \DateTime::createFromFormat('Y-m-d H:i:s', $bas);
            $ikinci = $ort->add(new \DateInterval('PT60M'));
            $son = $ikinci->format('Y-m-d H:i:s');
            $events[] = ['id' => $book->id, 'title' => $book->name, 'start' => $bas, 'son' => $son, 'color' => $this->random_color_part()];
        }

        if (request()->ajax()) {

            $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
            $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');

            $data = Event::whereDate('start', '>=', $start)->whereDate('end',   '<=', $end)->get(['id', 'title', 'start', 'end']);
            return Response::json($events);
        }
        $user = auth()->user();
        if ($user->role === RoleConstant::ROLE_ADMIN) {
            $restaurants = Restaurant::all();
        } else {
            $restaurants = Restaurant::where('id', '=', $user->restaurant_id)->get();
        }
        return view('backend.bookings.calendar', compact('restaurants'));
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
        if ($request->ajax()) {
            return $booking;
        }
        alert()->success('Rezervasyon kaydedildi', 'Kayıt Başarılı');
        return redirect(route('admin.bookings.index'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Booking $booking)
    {
        // dd($booking);
        if ($request->ajax()) {
            return response()->json($booking);
        }
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
        alert()->success('Rezervasyon kaydedildi', 'Kayıt Başarılı');
        return redirect(route('admin.bookings.index'));
    }
    public function updateAjax(Request   $request, Booking $booking)
    {
        //UPDATE'e status eklenecek
        $validated = request()->validate([
            'quantity' => 'required',
            'notes' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required'
        ]);
        // $booking = Booking::find($validated['rezid']);
        $booking->update($validated);
        return true;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Booking $booking)
    {
        //burada status iptal yapılabilir.
        if ($booking->status !== 0) {
            alert()->error('Yalnızca günü geçmemiş rezervasyonları iptal edebilirsiniz.', 'Hata !!!');
            return redirect(route('admin.bookings.index'));
        }

        $booking->status = 1;
        $booking->save();
        if ($request->ajax()) {
            return $booking;
        }
        return redirect(route('admin.bookings.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function kapat(Request $request, Booking $booking)
    {
        //burada status iptal yapılabilir.
        if ($booking->status !== 0) {
            alert()->error('Yalnızca günü geçmiş rezervasyonları kapatabilirsiniz.', 'Hata !!!');
            return redirect(route('admin.bookings.index'));
        }

        $booking->status = 2;
        $booking->save();
        if ($request->ajax()) {
            return $booking;
        }
        return redirect(route('admin.bookings.index'));
    }
}