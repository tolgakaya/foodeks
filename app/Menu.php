<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Menu extends Model
{

    protected $guarded = [];
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
    public function meals()
    {
        return $this->belongsToMany(Meal::class)
            ->using(MealMenu::class)
            ->withPivot(['id', 'fee', 'menu_id', 'meal_id']);
    }
    public function options()
    {
        return $this->hasManyThrough(Option::class, Meal::class)
            ->withPivot(['id', 'fee', 'menu_id', 'meal_id']);
    }

    public function extras()
    {
        return $this->hasManyThrough(Extra::class, Meal::class)
            ->withPivot(['id', 'fee', 'menu_id', 'meal_id']);
    }
}