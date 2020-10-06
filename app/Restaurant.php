<?php

namespace App;

use DateTime;
use Facade\FlareClient\Time\Time;
use Illuminate\Database\Eloquent\Model;
use Malhal\Geographical\Geographical;
use Ramsey\Uuid\Type\Integer;

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

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function restaurantAvatar()
    {
        if ($this->avatar != null) {
            return  asset('images/' . $this->avatar);
        }
        return asset('frontend/img/logo.png');
    }

    public function dayName($day)
    {
        if ($day == 1) {
            return 'Pazartesi';
        } else      if ($day == 2) {
            return 'Salı';
        } else      if ($day == 3) {
            return 'Çarşamba';
        } else      if ($day == 4) {
            return 'Perşembe';
        } else      if ($day == 5) {
            return 'Cuma';
        } else      if ($day == 6) {
            return 'Cumartesi';
        } else      if ($day == 7) {
            return 'Pazar';
        }
    }
    public function validateBookingTime($date, $time)
    {
        $gun = $date->format('N');
        $zamanlar = $this->RestaurantTimes()->where('day', $gun)->first();
        $available = ['open' => '10:00:00', 'close' => '23:00:00'];
        if ($zamanlar != null) {
            $openning = \DateTime::createFromFormat('H:i:s', $zamanlar->openning_time);
            $closing = \DateTime::createFromFormat('H:i:s', $zamanlar->closing_time);
            if ($zamanlar != null && $openning <= $time && $closing >= $time) {
                return true;
            }
        }

        return false;
    }
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
        $time = $today->format('H:i:s');

        $zamanlar = $this->RestaurantTimes()->where('day', $gun)->first();
        $closing = null;
        $openning = null;

        if ($zamanlar != null) {

            $openning = \DateTime::createFromFormat('H:i:s', $zamanlar->openning_time);
            $closing = \DateTime::createFromFormat('H:i:s', $zamanlar->closing_time);

            if ($openning <= $today && $today <= $closing) {
                return true;
            }
            return false;
        }
        return true;
    }
}