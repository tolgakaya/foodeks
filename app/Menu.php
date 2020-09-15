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
            ->withTimestamps()
            ->using(MealMenu::class)
            ->withPivot(['id', 'fee', 'pasif', 'menu_id', 'meal_id']);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class)
            ->using(CategoryMenu::class)
            ->withPivot(['id', 'category_id', 'menu_id']);
    }
}