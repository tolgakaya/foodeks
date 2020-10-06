<?php

namespace App\Http\Controllers\Admin;

use App\PageSettings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = PageSettings::first();
        return view('backend.pages.settings.index', compact('page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'logo' => 'required',
            'company' => 'required',
            'radius_service' => 'required'
        ]);
        if ($request->payment_card) {
            $validated['payment_card'] = $request->payment_card;
        }
        if ($request->payment_setcard) {
            $validated['payment_setcard'] = $request->payment_setcard;
        }
        if ($request->style) {
            $validated['style'] = $request->style;
        }
        if ($request->payment_ticket) {
            $validated['payment_ticket'] = $request->payment_ticket;
        }
        if ($request->payment_multinet) {
            $validated['payment_multinet'] = $request->payment_multinet;
        }
        if ($request->payment_cash) {
            $validated['payment_cash'] = $request->payment_cash;
        }
        if ($request->multi_branch) {
            $validated['multi_branch'] = $request->multi_branch;
        }
        if ($request->facebook) {
            $validated['facebook'] = $request->facebook;
        }
        if ($request->instagram) {
            $validated['instagram'] = $request->instagram;
        }
        if ($request->youtube) {
            $validated['youtube'] = $request->youtube;
        }
        if ($request->twitter) {
            $validated['twitter'] = $request->twitter;
        }

        $settings = PageSettings::first();
        if ($settings != null) {
            $settings->update($validated);
            $settings->save();
        } else {
            PageSettings::create($validated);
        }

        return redirect()->route('admin.pages.settings.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PageSettings  $pageSettings
     * @return \Illuminate\Http\Response
     */
    public function show(PageSettings $pageSettings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PageSettings  $pageSettings
     * @return \Illuminate\Http\Response
     */
    public function edit(PageSettings $pageSettings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PageSettings  $pageSettings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PageSettings $pageSettings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PageSettings  $pageSettings
     * @return \Illuminate\Http\Response
     */
    public function destroy(PageSettings $pageSettings)
    {
        //
    }
}