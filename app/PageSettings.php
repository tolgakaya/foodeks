<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageSettings extends Model
{
    protected $guarded = [];

    public function companyLogo()
    {
        if ($this->logo != null) {
            return  asset('images/' . $this->logo);
        }
        return asset('frontend/img/logo.png');
    }
}