<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RestaurantAd extends Model
{
    protected $guarded = [];

    public function Restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
    // public function ad()
    // {
    //     $ads = [];
    //     if ($this->filename != null) {
    //         $ads['filename'] = asset('images/' . $this->filename);
    //     }

    //     return $ads;
    // }
}