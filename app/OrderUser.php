<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderUser extends Pivot
{
    protected $guarded = [];
    protected $table = 'order_user';
    public $incrementing = true;

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}