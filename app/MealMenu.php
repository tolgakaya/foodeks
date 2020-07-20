<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;
// use Illuminate\Database\Eloquent\Model;

class MealMenu extends Pivot
{
    protected $guarded = [];
    protected $table = 'meal_menu';
    public $incrementing = true;


    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function meal()
    {
        return $this->belongsTo(Meal::class);
    }
}