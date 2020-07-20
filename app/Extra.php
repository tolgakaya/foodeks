<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Extra extends Model
{
    protected $guarded = [];

    public function meal()
    {
        return $this->belongsTo(Meal::class);
    }
}