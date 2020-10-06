<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\RestaurantTime;
use App\Restaurant;

class RestaurantTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Restaurant $restaurant)
    {
        $times = $restaurant->RestaurantTimes;
        $days = [
            1 => 'Pazartesi',
            2 => 'Salı',
            3 => 'Çarşamba',
            4 => 'Perşembe',
            5 => 'Cuma',
            6 => 'Cumartesi',
            7 => 'Pazar'
        ];
        $flipDays = array_flip($days);

        $gunler = [];

        foreach ($days as $i => $day) {
            foreach ($times as  $time) {
                if ($time->day === $i) {
                    $gunler[$day] = $time;
                }
            }
        }
        $eksik = array_diff_key($flipDays, $gunler);
        // dd($eksik);
        return view('backend.restaurant.times', compact('restaurant', 'gunler', 'eksik'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Restaurant $restaurant)
    {
        $open = $request->openning_time;
        $close = $request->closing_time;
        $data = [];
        for ($i = 1; $i < 8; $i++) {
            $data[$i] = [
                'restaurant_id' => $restaurant->id,
                'day' => $i,
                'openning_time' => $open[$i],
                'closing_time' => $close[$i]
            ];
        }
        // dd($data);
        foreach ($data as $i => $d) {
            $time =  RestaurantTime::where('restaurant_id', $restaurant->id)->where('day', $d['day'])->first();
            if ($time != null) {
                $time->update($d);
            } else {
                RestaurantTime::create($d);
            }
        }
        return redirect()->route('admin.restaurants.times.index', compact('restaurant'));
    }
}