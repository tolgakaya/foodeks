<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $guarded = [];
    // protected $dateFormat = 'Y-m-d';
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /*
    TODO:: tarih  formatı daha larevel deiline çevrilim
    */
    public function formatDate()
    {
        //veritabaından gelecek datei göstermek için kullanıyoruz
        $date = \DateTime::createFromFormat('Y-m-d', $this->date);
        return $date->format('d/m/Y');
    }

    public function bookStatus()
    {
        $tarih = date('Y-m-d H:i:s', strtotime("$this->date $this->time"));
        $simdi = date('Y-m-d H:i:s', strtotime(now()->toDateTimeString()));
        $message = "Geçerli";
        if ($this->status == 1) {
            $message = 'İptal';
        } elseif ($this->status == 2) {
            $message = 'Kapatıldı';
        } elseif ($this->status == 0 && $tarih <= $simdi) {
            $message = 'Günü geçmiş';
        }
        return $message;
    }
}