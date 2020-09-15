<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CategoryMenu extends Pivot
{
    protected $guarded = [];
    protected $table = 'category_menu';
    public $incrementing = true;
    public $timestamps = false;

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}