<?php

namespace App\Http\Controllers\Admin;

use App\Menu;
use App\Category;
use App\Extra;
use App\Meal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Restaurant;
use App\Http\Resources\MealResource;
use App\MealMenu;
use App\Option;
use App\User;
use App\Helpers\RoleConstant;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = auth()->user();
        if ($user->role === RoleConstant::ROLE_ADMIN) {
            $menus = Menu::all();
        } else {
            //userin yer aldığı restoranların menüleri
            $restoran = $user->restaurant_id;
            $menus = Menu::where('restaurant_id', $restoran)->get();
        }
        return view('backend.menus..index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $restaurants = Restaurant::all();
        return view('backend.menus..create', compact('restaurants'));
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
            'restaurant_id' => 'required',
            'name' => 'required',
            'description' => 'required',

        ]);
        $menu = Menu::create($validated);
        $menus = Menu::all();
        return redirect()->route('admin.menus.index', compact('menus'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        $restaurants = Restaurant::all();
        return view('backend.menus..edit', compact('menu', 'restaurants'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Menu $menu)
    {
        // dd(request()->all());
        $validated = request()->validate([
            'restaurant_id' => 'required',
            'name' => 'required',
            'description' => 'required',
        ]);
        $menu->update($validated);
        $menus = Menu::all();
        return redirect()->route('admin.menus.index', compact('menus'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sil(Menu $menu)
    {
        $menu->delete();
        return redirect()->back();
    }

    public function details(Menu $menu)
    {
        $restaurants = Restaurant::all();
        // $meals = Meal::all();
        $categories = Category::all();

        // $details = $menu->
        // dd($menu->options);
        // dd($details);
        // $myMenu = $menu->with('meals', 'meals.options', 'meals.extras')->get()->groupBy('category_id');
        $meals = $menu->meals()->with('options', 'extras', 'category')->get();
        // dd($meals);
        return view('backend.menus..details', compact('menu', 'restaurants', 'meals', 'categories'));
    }

    public function mealAdd(Menu $menu)
    {
        $validated = request()->validate([
            'meal_id' => 'required',
            'fee' => 'required',
            'category' => 'required'
        ]);
        $meal_id = $validated['meal_id'];
        $fee = $validated['fee'];
        $menu->meals()->detach($meal_id);
        $menu->meals()->attach($meal_id, ['fee' => $fee]);
        // $menu->meals()->where('phone_problem', $problem->id)->firstOrFail()
        // $menu->load('meals');
        // return new MealResource($menu->meals()->latest()->get());
        $myId = MealMenu::where(['menu_id' => $menu->id, 'meal_id' => $validated['meal_id']])->firstOrFail()->id;
        $last = $menu->meals()->with('options')->where('category_id', $validated['category'])->get();

        return response()->json(compact('last', 'myId'));
    }

    public function mealDelete(Menu $menu, Request $request)
    {

        $validated = request()->validate([
            'mealid' => 'required',
        ]);

        $menu->meals()->detach($validated['mealid']);

        return response()->json('başarılı');
    }
    public function optionAdd(MealMenu $mealmenu)
    {
    }
    public function extraAdd(MealMenu $mealmenu)
    {
    }
}