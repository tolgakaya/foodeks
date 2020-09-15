<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function menus()
    {
        return $this->belongsToMany(Menu::class)
            ->withTimestamps()
            ->using(MealMenu::class)
            ->withPivot(['id', 'fee', 'pasif', 'menu_id', 'meal_id']);
    }
    public function options()
    {
        return $this->hasMany(Option::class);
    }
    public function extras()
    {
        return $this->hasMany(Extra::class);
    }
    public function path()
    {
        return  asset('images/' . $this->image);
    }
}