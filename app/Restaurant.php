<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Malhal\Geographical\Geographical;


class Restaurant extends Model
{
    use Geographical;

    protected static $kilometers = true;

    protected $guarded = [];

    public function RestaurantDetail()
    {
        return $this->hasOne(RestaurantDetail::class);
    }
    public function RestaurantGalleries()
    {
        return $this->hasMany(RestaurantGallery::class);
    }
    public function RestaurantTimes()
    {
        return $this->hasMany(RestaurantTime::class);
    }
    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // public function openCloseTimes()
    // {
    //     //kullanıcının current timeına göre paket servisinin yapıldığı saatleri gösterir
    //     $today = new DateTime();
    //     $gun = $today->format('N');
    //     $simdi = $today->format('H:i:s');

    //     $zamanlar = $this->RestaurantTimes()->where('day', $gun)->first();
    //     $available = ['open' => '10:00:00', 'close' => '23:00:00'];
    //     if ($zamanlar != null && $zamanlar->openning_time  <  $simdi  && $zamanlar->closing_time) {
    //         $available = ['open' => $simdi, 'close' => $zamanlar->closing_time];
    //     }
    //     return $available;
    // }
    public function openCloseTimes()
    {
        //kullanıcının current timeına göre paket servisinin yapıldığı saatleri gösterir
        $today = new DateTime();
        $gun = $today->format('N');
        $simdi = $today->format('H:i:s');

        $zamanlar = $this->RestaurantTimes()->where('day', $gun)->first();
        $available = ['open' => '10:00:00', 'close' => '23:00:00'];
        if ($zamanlar != null && $zamanlar->openning_time  <  $simdi  && $zamanlar->closing_time) {
            $available = ['open' => $zamanlar->openning_time, 'close' => $zamanlar->closing_time];
        }
        return $available;
    }

    public function isAvailable()
    {
        //kullanıcının current timeına göre paket servisinin yapıldığı saatleri gösterir
        $today = new DateTime();
        $gun = $today->format('N');
        $simdi = $today->format('H:i:s');

        $zamanlar = $this->RestaurantTimes()->where('day', $gun)->first();

        if ($zamanlar == null || ($zamanlar->openning_time  <  $simdi  && $simdi < $zamanlar->closing_time)) {
            return true;
        }
        return false;
    }
}