<?php

namespace App\Http\Controllers\Admin;

use App\Meal;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $meals = Meal::all();
        return view('backend.meals..index', compact('meals'));
    }
    public function modal($categoryid)
    {

        $meals = Meal::where('category_id', $categoryid)->get();
        return response()->json($meals);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('backend.meals..create', compact('categories'));
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
            'category_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'image' => 'required'
        ]);
        $meal = Meal::create($validated);
        $meals = Meal::all();
        return redirect()->route('admin.meals.index', compact('meals'));
    }
    public function MediaUpdate(Request $request)
    {
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('images'), $imageName);
        return response()->json(['success' => $imageName]);
    }
    public function MediaCreate(Request $request)
    {
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('images'), $imageName);
        return response()->json(['success' => $imageName]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Meal $meal)
    {
        $categories = Category::all();
        return view('backend.meals..edit', compact('meal', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Meal $meal)
    {
        // dd($request->all());
        $validated = request()->validate([
            'category_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'image' => 'required'
        ]);
        $meal->update($validated);
        $meals = Meal::all();
        return redirect()->route('admin.meals.index', compact('meals'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        ///createden gelen remove files 
        $filename =  $request->get('filename');

        $path = public_path() . '/images/' . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return response()->json(['file' => $filename]);
    }

    public function sil(Meal $meal)
    {
        $meal->delete();
        return redirect()->back();
    }

    public function details(Meal $meal)
    {
        $details = $meal->with(['options', 'extras'])->firstOrFail();
        $options = $meal->options()->get();
        // dd($options);
        return view('backend.meals.details', compact('options', 'meal'));
    }

    public function addOption(Meal $meal)
    {
        $validated = request()->validate([
            'option' => 'required',
            'fee' => 'required',
        ]);
        $meal->options()->create($validated);
        return $meal->options()->get();
    }

    public function addExtra(Meal $meal)
    {
        $validated = request()->validate([
            'extra' => 'required',
            'fee' => 'required',
        ]);
        $meal->extras()->create($validated);
        return $meal->extras()->get();
    }
    public function options(Meal $meal)
    {
        return $meal->options()->get();
    }

    public function extras(Meal $meal)
    {
        return $meal->extras()->get();
    }
}