<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageHome extends Model
{
    protected $guarded = [];

    public function paralax()
    {
        if ($this->paralax_image != null) {
            return  asset('images/' . $this->paralax_image);
        }
        return asset('frontend/img/adana_web.jpg');
    }
    public function paralax_second()
    {
        if ($this->paralax_image2 != null) {
            return  asset('images/' . $this->paralax_image2);
        }
        return asset('frontend/img/adana_web.jpg');
    }
}