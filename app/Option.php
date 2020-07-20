<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $guarded = [];

    public function meal()
    {
        return $this->belongsTo(Meal::class);
    }
}