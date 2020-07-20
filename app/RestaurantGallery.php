<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RestaurantGallery extends Model
{
    protected $guarded = [];

    public function Restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}