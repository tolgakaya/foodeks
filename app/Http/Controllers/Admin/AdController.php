<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\RestaurantAd;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads = RestaurantAd::first();
        return view('backend.pages.ad.sidead', compact('ads'));
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
            'link' => 'required',
            'filename' => 'required',
            'link2' => 'required',
            'filename2' => 'required',
            'link3' => 'required',
            'filename3' => 'required',
            'link4' => 'required',
            'filename4' => 'required',
        ]);
        $ads = RestaurantAd::first();
        if ($ads != null) {
            $ads->update($validated);
        } else {
            $ads = RestaurantAd::create($validated);
        }
        return $ads;
    }
}