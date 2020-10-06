<?php

namespace App\Http\Controllers\Admin;

use App\PageHome;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = PageHome::first();
        return view('backend.pages.home.index', compact('page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $validated = request()->validate([
            'video' => 'required',
            'slogan' => 'required',
            'sub_slogan' => 'required',
            'paralax_image' => 'required',
            'paralax_text' => 'required',
            'paralax_sub_text' => 'required',
            'paralax_image2' => 'required',
            'paralax_text2' => 'required',
            'paralax_sub_text2' => 'required'
        ]);
        if (isset($request->show_how)) {
            $validated['show_how'] = true;
        }
        if (isset($request->menu_show)) {
            $validated['menu_show'] = true;
        }
        if (isset($request->paralax_show)) {
            $validated['paralax_show'] = true;
        }
        $page = PageHome::first();
        if ($page != null) {
            $page->update($validated);
            return redirect()->route('admin.pages.home.index');
        }
        PageHome::create($validated);
        return redirect()->route('admin.pages.home.index');
        // dd($validated);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PageHome  $pageHome
     * @return \Illuminate\Http\Response
     */
    public function show(PageHome $pageHome)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PageHome  $pageHome
     * @return \Illuminate\Http\Response
     */
    public function edit(PageHome $pageHome)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PageHome  $pageHome
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PageHome $pageHome)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PageHome  $pageHome
     * @return \Illuminate\Http\Response
     */
    public function destroy(PageHome $pageHome)
    {
        //
    }
}