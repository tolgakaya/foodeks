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
    public function categories()
    {
        return $this->belongsToMany(Menu::class)
            ->using(CategoryMenu::class)
            ->withPivot(['id', 'category_id', 'menu_id']);
    }
}