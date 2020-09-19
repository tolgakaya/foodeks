<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Helpers\RoleConstant;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'adi', 'email', 'password', 'mobile', 'role', 'restaurant_id', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    //depricated(kullanmıyoruz)
    public function menus()
    {
        return $this->hasManyThrough(Menu::class, Restaurant::class);
    }
    public function UserRole()
    {
        return RoleConstant::UserRole($this->role);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    public function paketciOrders()
    {
        return $this->belongsToMany(Order::class)
            ->using(OrderUser::class)
            ->withPivot(['id', 'order_id', 'user_id', 'begin_date', 'begin_date', 'begin_time', 'end_time', 'notes']);
    }
    public function userAvatar()
    {
        return  asset('images/' . $this->avatar);
    }
    public function getUserRoleAttribute()
    {
        return RoleConstant::UserRole($this->role);
    }
    protected $appends = ['user_role'];
}