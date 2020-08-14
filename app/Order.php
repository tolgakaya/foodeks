<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function orderdetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}