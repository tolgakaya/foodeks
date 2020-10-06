<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageRestaurant extends Model
{
    protected $guarded = [];

    public function paralax()
    {
        if ($this->paralax_image != null) {
            return  asset('images/' . $this->paralax_image);
        }
        return asset('frontend/img/adana_web.jpg');
    }
}