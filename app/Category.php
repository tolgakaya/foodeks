<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];
    public function meals()
    {
        return $this->hasMany(Meal::class);
    }
}