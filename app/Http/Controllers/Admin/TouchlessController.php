<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Restaurant;
use Illuminate\Http\Request;
use Darryldecode\Cart;

class TouchlessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexOld(Restaurant $restaurant, $category = null)
    {
        $menu = $restaurant->menus()->with('meals', 'meals.options', 'meals.extras', 'meals.category')->first();
        // $menu=
        if ($category == null) {
            $category = $menu->categories()->first();
        }
        $meals = $menu->meals()->where('pasif', 0)->where('category_id', $category)->get();
        $categories = $menu->categories;
        return view('backend.touchless.index', compact('menu', 'categories', 'meals'));
    }
    public function index(Restaurant $restaurant, $category)
    {
        //burada gelen categoriyi istiyor 
        $menu = $restaurant->menus()->with('meals', 'meals.options', 'meals.extras', 'meals.category')->first();
        $kategoriler = $menu->categories()->orderBy('category_id', 'asc')->get();
        // dd($kategoriler);

        $categories = $kategoriler->pluck('id')->toArray();

        $index = array_search($category, $categories);

        $countCategories = count($categories);
        $currentCategoryId = $category;
        $nextCategoryId = null;
        $beforeCategoryId = null;
        $currentIndex = $index;
        $nextIndex = null;
        $beforeIndex = null;

        $currentCategoryId = $categories[$index];
        $currentIndex = $index;
        if ($countCategories >= ($index + 1)) {
            $nextCategoryId = $categories[$index + 1];
            $nextIndex = $index + 1;
        }
        if (($index - 1) >= 0) {
            $beforeCategoryId = $categories[$index - 1];
            $beforeIndex = $index - 1;
        }

        // return [
        //     'before' => $beforeCategoryId,
        //     'current' => $currentCategoryId,
        //     'next' => $nextCategoryId,
        //     'pluck' => $categories,
        //     'category' => $category
        // ];

        if ($category == null) {
            $category = $menu->categories()->first();
        }
        $meals = $menu->meals()->where('pasif', 0)->where('category_id', $currentCategoryId)->get();



        return view('backend.touchless.index', compact('menu', 'categories', 'meals', 'currentCategoryId', 'nextCategoryId', 'beforeCategoryId', 'kategoriler', 'currentIndex', 'beforeIndex', 'nextIndex', 'quantity', 'total'));
    }

    public function nextBefore($masaid, Restaurant $restaurant, $category = null, $next = null)
    {
        //burada gelen category mevcut gösterilen category_id
        //categoryi indexed arraye atıp sıradaki yada, gerideki categoryi gönderecez.
        // return phpinfo();
        $menu = $restaurant->menus()->with('meals', 'meals.options', 'meals.extras', 'meals.category')->first();
        $kategoriler = $menu->categories()->orderBy('category_id', 'asc')->get();
        // dd($kategoriler);

        $categories = $kategoriler->pluck('id')->toArray();
        if ($category == null) {
            $index = 0;
        } else {
            $index = array_search($category, $categories);
        }
        $countCategories = count($categories);
        $currentCategoryId = null;
        $nextCategoryId = null;
        $beforeCategoryId = null;
        $currentIndex = 0;
        $nextIndex = null;
        $beforeIndex = null;
        if ($next == null) {
            //eger ileri gidiyorsa
            $currentCategoryId = $categories[$index];
            $currentIndex = $index;
            if ($countCategories > ($index + 1)) {
                $nextCategoryId = $categories[$index + 1];
                $nextIndex = $index + 1;
            }
            if (($index - 1) > 0) {
                $beforeCategoryId = $categories[$index - 1];
                $beforeIndex = $index - 1;
            }
        } elseif ($next == 1) {
            //eger ileri gidiyorsa
            if ($countCategories >= ($index + 1)) {
                $currentCategoryId = $categories[$index + 1];
                $currentIndex = $index + 1;
                $beforeCategoryId = $categories[$index];
                $beforeIndex = $index;
            }
            if ($countCategories > ($index + 2)) {
                $nextCategoryId = $categories[$index + 2];
                $nextIndex = $index + 2;
            }
        } else {
            //geri gidiyorsa
            if (($index - 1) >= 0) {
                $currentCategoryId = $categories[$index - 1];
                $currentIndex = $index - 1;
            }
            $nextCategoryId = $categories[$index];
            $nextIndex = $index;
            if (($index - 2) >= 0) {
                $beforeCategoryId = $categories[$index - 2];
                $beforeIndex = $index - 2;
            }
        }
        // return [
        //     'before' => $beforeCategoryId,
        //     'current' => $currentCategoryId,
        //     'next' => $nextCategoryId,
        //     'pluck' => $categories,
        //     'category' => $category
        // ];

        if ($category == null) {
            $category = $menu->categories()->first();
        }
        $meals = $menu->meals()->where('pasif', 0)->where('category_id', $currentCategoryId)->get();
        $cartItems = \Cart::session($masaid)->getContent();
        $total = 0;
        $quantity = 0;
        foreach ($cartItems as   $row) {
            $base = $row->quantity * $row->price;
            $quantity += $row->quantity;
            $opfee = 0;
            $extfee = 0;
            if ($row->attributes['option'] !== null) {
                $opfee = $row->attributes['option']->fee * $row->quantity;
            }
            if ($row->attributes['extras'] !== null) {
                foreach ($row->attributes['extras']  as $ext) {
                    $extfee += $ext->fee;
                }
            }
            $total += $base + $extfee + $opfee;
        }
        return view('backend.touchless.index', compact('menu', 'categories', 'meals', 'currentCategoryId', 'nextCategoryId', 'beforeCategoryId', 'kategoriler', 'currentIndex', 'beforeIndex', 'nextIndex', 'quantity', 'total', 'cartItems', 'masaid'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}