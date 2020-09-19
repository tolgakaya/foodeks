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

// Route::get('/', function () {
//     return view(env('THEME') . '.home');
// })->name('home');

Route::get('/', function () {
    return view('frontend.home');
})->name('home');

Route::get('/', 'HomeController@index')->name('home');
Route::get('about', function () {
    return view('frontend.about');
})->name('about');

Route::get('faq', function () {
    return view('frontend.faq');
})->name('faq');

Route::get('contact', function () {
    return view('frontend.contact');
})->name('contact');


// Route::get('restaurants/show/{restaurant?}', function () {
//     return view('frontend.restaurants.show');
// })->name('restaurants.show');

Route::get('restaurants/test', function () {
    return view('frontend.restaurants.test');
})->name('restaurants.test');



Route::get('checkouts/create', function () {
    return view('frontend.checkouts.create');
})->name('checkouts.create');

Route::get('checkouts/result', function () {
    return view('frontend.checkouts.result');
})->name('checkouts.result');

Route::get('reservation', function () {
    return view('frontend.reservation.create');
})->name('reservation.create');
Route::get('modal', function () {
    return view('backend.media.modal');
})->name('modal.create');
Auth::routes();

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('change-password', 'ChangePasswordController@index');
    Route::post('change-password', 'ChangePasswordController@store')->name('change.password');

    Route::get('dashboard', 'AdminController@index')->name('dashboard');
    Route::get('alert/paket', 'AlertController@index')->name('alert.paket');
    Route::post('sms', 'AdminController@nida')->name('sms');
    Route::get('restaurants', 'RestaurantController@index')->name('restaurant.index');
    Route::get('restaurants/create', 'RestaurantController@create')->name('restaurant.create');
    Route::post('restaurants', 'RestaurantController@store')->name('restaurant.store');
    Route::get('restaurants/edit/{restaurant}', 'RestaurantController@edit')->name('restaurant.edit');
    Route::post('restaurants/update/{restaurant}', 'RestaurantController@update')->name('restaurant.update');
    Route::get('restaurants/distances', 'RestaurantController@distances')->name('restaurant.distances');
    Route::get('restaurants/users/{restaurant}', 'RestaurantController@users')->name('restaurant.users');
    Route::get('restaurants/staffs/{restaurant}', 'RestaurantController@staffs')->name('restaurant.staffs');
    Route::post('restaurants/users/{restaurant}', 'RestaurantController@assign')->name('restaurant.assign');
    Route::post('restaurants/users/unsign/{restaurant}', 'RestaurantController@unsign')->name('restaurant.unsign');



    Route::get('categories', 'CategoryController@index')->name('categories.index');
    Route::get('categories/create', 'CategoryController@create')->name('categories.create');
    Route::post('categories', 'CategoryController@store')->name('categories.store');
    Route::get('categories/edit/{category}', 'CategoryController@edit')->name('categories.edit');
    Route::post('categories/update/{category}', 'CategoryController@update')->name('categories.update');
    Route::get('categories/delete/{category}', 'CategoryController@destroy')->name('categories.delete');

    Route::get('meals', 'MealController@index')->name('meals.index');
    Route::get('meals/category/{category}', 'MealController@modal')->name('meals.category.index');
    Route::get('meals/create', 'MealController@create')->name('meals.create');
    Route::post('meals', 'MealController@store')->name('meals.store');
    Route::post('meals/media/create', 'MealController@MediaCreate')->name('meals.media.store');
    Route::post('meals/media/update', 'MealController@MediaUpdate')->name('meals.media.update');
    Route::get('meals/edit/{meal}', 'MealController@edit')->name('meals.edit');
    Route::get('meals/delete/{meal}', 'MealController@destroy')->name('meals.destroy');
    Route::get('meals/sil/{meal}', 'MealController@sil')->name('meals.sil');
    Route::post('meals/update/{meal}', 'MealController@update')->name('meals.update');
    Route::post('meals/media/delete', 'MealController@destroy')->name('meals.media.delete');

    Route::get('meals/details/{meal}', 'MealController@details')->name('meals.details');
    Route::post('meals/details/option/{meal}', 'MealController@addOption')->name('meals.details.option');
    Route::post('meals/details/extra/{meal}', 'MealController@addExtra')->name('meals.details.extra');

    Route::get('menus/list/', 'MenuController@index')->name('menus.index');
    Route::get('menus/sil/{menu}', 'MenuController@sil')->name('menus.sil');
    Route::get('menus/edit/{menu}', 'MenuController@edit')->name('menus.edit');
    Route::get('menus/details/{menu}', 'MenuController@details')->name('menus.details');
    Route::post('menus/details/{menu}', 'MenuController@mealAdd')->name('menus.details.add');
    Route::post('menus/details/delete/{menu}/', 'MenuController@mealDelete')->name('menus.details.delete');
    Route::post('menus/details/status/{menu}/', 'MenuController@mealUpdate')->name('menus.details.status');

    Route::post('menus/update/{menu}', 'MenuController@update')->name('menus.update');
    Route::get('menus/create', 'MenuController@create')->name('menus.create');
    Route::post('menus', 'MenuController@store')->name('menus.store');

    Route::get('users/create/', 'UserController@create')->name('users.create');
    Route::post('users', 'UserController@store')->name('users.store');
    Route::get('users', 'UserController@index')->name('users.index');
    Route::get('users/delete/{user}', 'UserController@destroy')->name('users.delete');

    Route::post('profile', 'ProfileController@store')->name('profile.store');
    Route::get('profile', 'ProfileController@index')->name('profile.index');

    Route::get('library/{chcbox?}', 'MediaController@index')->name('media.index');
    Route::get('library/detail/{filename}', 'MediaController@show')->name('media.show');
    Route::get('more', 'MediaController@more')->name('media.more');
    Route::post('library', 'MediaController@store')->name('media.store');
    Route::get('library/create', 'MediaController@create')->name('media.create');
    Route::post('library/delete', 'MediaController@destroy')->name('media.delete');
    Route::post('library/delete/mass', 'MediaController@destroymass')->name('media.delete.mass');
    Route::post('library/search/', 'MediaController@search')->name('media.search');

    //admin tarafında rezervasyon işlemleri
    Route::get('bookings', 'BookingController@index')->name('bookings.index');
    Route::get('bookings/current', 'BookingController@gunluk')->name('bookings.gunluk');
    Route::get('bookings/yarin', 'BookingController@yarin')->name('bookings.yarin');
    Route::get('bookings/create', 'BookingController@create')->name('bookings.create');
    Route::post('bookings', 'BookingController@store')->name('bookings.store');
    Route::get('bookings/edit/{booking}', 'BookingController@edit')->name('bookings.edit');
    Route::get('bookings/delete/{booking}', 'BookingController@destroy')->name('bookings.delete');
    Route::post('bookings/{booking}', 'BookingController@update')->name('bookings.update');

    Route::get('orders/{status?}', 'OrderController@index')->name('orders.index');
    Route::get('orders/goruldu/{order}', 'OrderController@goruldu')->name('orders.goruldu');
    Route::get('orders/kapat/{order}', 'OrderController@kapat')->name('orders.kapat');
    Route::get('orders/masa/adisyons/{status?}', 'OrderController@indexMasa')->name('orders.indexMasa');
    Route::post('orders/store', 'OrderController@store')->name('orders.store');
    Route::post('orders/status/update', 'OrderController@statusUpdate')->name('orders.status.update');
    Route::post('orders/tasks', 'OrderController@taskStore')->name('orders.tasks.store');
    Route::get('orders/create/{restaurant?}', 'OrderController@create')->name('orders.create');
    Route::get('orders/edit/{order}', 'OrderController@edit')->name('orders.edit');
    Route::post('orders/update/{order}', 'OrderController@update')->name('orders.update');
    Route::post('orders/addresses/{user}', 'OrderController@addresses')->name('orders.addresses');
    Route::post('orders/meal/details/{meal}', 'OrderController@mealDetails')->name('orders.meal.details');
    Route::post('orders/detail/update', 'OrderController@detailUpdate')->name('orders.detail.update');
    Route::post('orders/detail/delete', 'OrderController@detailDelete')->name('orders.detail.delete');

    Route::get('pages/home', 'PageHomeController@index')->name('pages.home.index');
    Route::post('pages/home', 'PageHomeController@store')->name('pages.home.store');

    Route::get('pages/settings', 'PageSettingsController@index')->name('pages.settings.index');
    Route::post('pages/settings', 'PageSettingsController@store')->name('pages.settings.store');

    Route::get('pages/about', 'PageAboutController@index')->name('pages.about.index');
    Route::get('pages/about/more', 'PageAboutController@more')->name('about.more');
    Route::post('pages/about/media',  'PageAboutController@mediastore')->name('about.media.store');
    Route::post('pages/about',  'PageAboutController@store')->name('about.store');

    Route::post('pages/about/media/delete', 'PageAboutController@destroy')->name('about.media.delete');
    Route::post('pages/about/media/delete/mass', 'PageAboutController@destroymass')->name('about.media.delete.mass');
    Route::post('pages/about/media/search', 'PageAboutController@search')->name('about.media.search');
});
Route::get('carriers/orders/{status?}', 'CarrierController@index')->middleware((['auth', 'carrier']))->name('carrier.dashboard');
Route::post('carriers/orders/status/{order}', 'CarrierController@status')->middleware((['auth', 'carrier']))->name('carrier.status');
Route::get('carriers/orders/show/{order}', 'CarrierController@addshow')->name('carriers.orders.addshow');

Route::get('qr/orders/{order}', 'CarrierController@qr')->middleware((['auth', 'carrier']))->name('carrier.orders.qr');

Route::get('api/restaurant/{restaurant}', 'Api\RestaurantController@show');
Route::get('api/restaurants/', 'Api\RestaurantController@index');
Route::get('api/orders/{order}', 'Api\RestaurantController@address')->name('api.orders.address');


Route::group(['as' => 'customer.', 'prefix' => 'customer', 'namespace' => 'Customer', 'middleware' => ['auth', 'customer']], function () {
    Route::get('dashboard', 'CustomerController@index')->name('dashboard');
    Route::get('create', 'CustomerController@create')->name('create');
});

Route::get('/restaurants/{viewType?}', 'RestaurantController@index')->name('restaurants.index');
Route::post('/restaurant/search', 'RestaurantController@index')->name('searchresult');
Route::get('restaurants/{restaurant}', 'RestaurantController@show')->name('restaurants.show');
Route::get('restaurants/menu/{restaurant}', 'RestaurantController@menu')->name('restaurants.menu');

Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/cart/add/{masaid?}/{menuid?}', 'CartController@store')->name('cart.add');
Route::post('/cart/update/rowid', 'CartController@update')->name('cart.update');
Route::post('/cart/delete/{masaid?}/{menuid?}', 'CartController@destroy')->name('cart.remove');

Route::get('orders/create', 'OrderController@create')->name('orders.create');
Route::post('orders', 'OrderController@store')->name('orders.store');
Route::get('orders/masa/{masaid}/{menuid}', 'OrderController@masaStore')->name('orders.masaStore');
Route::get('/address/{address}', 'OrderController@address')->name('orders.address');

Route::get('/bookings/create/{restaurant}', 'BookingController@create')->name('bookings.create');
Route::post('/bookings', 'BookingController@store')->name('bookings.store');
Route::get('/bookings/edit/{booking}', 'BookingController@edit')->name('bookings.edit');
Route::post('/bookings/{booking}', 'BookingController@update')->name('bookings.update');
Route::get('/touchless', 'Admin\TouchlessController@index')->name('touchless.index');
Route::get('/touchless/{masaid}/{restaurant}/{category?}/{next?}', 'Admin\TouchlessController@nextBefore')->name('touchless.paging');

Route::post('gonder', 'Admin\CKEditorController@upload')->name('gonder');