<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RestaurantTime extends Model
{
    protected $guarded = [];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}