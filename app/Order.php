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
    public function task()
    {
        return $this->hasOne(Task::class);
    }
    public function orderdetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
    public function address()
    {
        return $this->belongsTo(Address::class);
    }
    // created 1, ready to go 2, on the way 3, teslim edildi 4, cancelled 5,
    public function orderStatus()
    {
        $status = $this->status;
        if ($status == 1) {
            return 'Yeni Sipariş';
        } elseif ($status == 2) {
            return 'Mutfaktan Çıktı';
        } elseif ($status == 3) {
            return 'Yolda';
        } elseif ($status == 4) {
            return 'Teslim Edildi';
        } elseif ($status == 5) {
            return 'İptal Edildi';
        }
    }
    public function statusStyle()
    {
        $status = $this->status;
        if ($status == 1) {
            return 'badge bg-danger text-white';
        } elseif ($status == 2) {
            return 'badge bg-warning text-white';
        } elseif ($status == 3) {
            return 'badge bg-success text-white';
        } elseif ($status == 4) {
            return 'badge bg-primary text-white';
        } elseif ($status == 5) {
            return 'badge bg-secondary text-white';
        }
    }
}