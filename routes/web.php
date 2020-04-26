<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('frontend.home');
})->name('home');

Route::get('about', function () {
    return view('frontend.about');
})->name('about');

Route::get('faq', function () {
    return view('frontend.faq');
})->name('faq');

Route::get('contact', function () {
    return view('frontend.contact');
})->name('contact');

Route::get('/restaurants/{viewType?}', 'RestaurantController@index')->name('restaurants.index');

Route::get('restaurants/show/{restaurant?}', function () {
    return view('frontend.restaurants.show');
})->name('restaurants.show');

Route::get('restaurants/test', function () {
    return view('frontend.restaurants.test');
})->name('restaurants.test');

Route::get('orders/create', function () {
    return view('frontend.orders.create');
})->name('orders.create');

Route::get('checkouts/create', function () {
    return view('frontend.checkouts.create');
})->name('checkouts.create');

Route::get('checkouts/result', function () {
    return view('frontend.checkouts.result');
})->name('checkouts.result');

Route::get('reservation', function () {
    return view('frontend.reservation.create');
})->name('reservation.create');
Auth::routes();

// Route::get('/admin/dashboard', function () {
//     return view('admins.dashboard');
// })->name('admin')->middleware('admin');

// Route::get('/customer/dashboard', function () {
//     return view('frontend.customers.dashboard');
// })->name('customer')->middleware('customer');

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('dashboard', 'AdminController@index')->name('dashboard');
    // Route::get('dashboard', 'AdminController@index')->name('dashboard');
});

Route::group(['as' => 'customer.', 'prefix' => 'customer', 'namespace' => 'Customer', 'middleware' => ['auth', 'customer']], function () {
    Route::get('dashboard', 'CustomerController@index')->name('dashboard');
    Route::get('create', 'CustomerController@create')->name('create');
});


// Route::get('/home', 'HomeController@index')->name('home');