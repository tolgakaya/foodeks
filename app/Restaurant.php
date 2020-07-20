<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Malhal\Geographical\Geographical;


class Restaurant extends Model
{
    use Geographical;

    protected static $kilometers = true;

    protected $guarded = [];

    public function RestaurantDetail()
    {
        return $this->hasOne(RestaurantDetail::class);
    }
    public function RestaurantGalleries()
    {
        return $this->hasMany(RestaurantGallery::class);
    }
    public function RestaurantTimes()
    {
        return $this->hasMany(RestaurantTime::class);
    }
    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
}