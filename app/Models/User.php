<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasApiTokens, HasFactory, Notifiable;

    /*
     *
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'isVerified',
        'google_token',
        'image',
        'code',
        'active',
        'lat',
        'lang',
        'address',
    ];

    /*
     *
     * The attributes that should be hidden for serialization.
     *
     */
    protected $hidden = [
        'password',
        'remember_token',
        'password',
        'isVerified',
        'active',
        'fcm_token',
        'google_token',
        'created_at',
        'updated_at',
        'email_verified_at' 
    ];

    /*
     *
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

        /**
     * Specifies the user's FCM token
     *
     * @return string|array
     */
    public function routeNotificationForFcm()
    {
        return $this->google_token;
    }

   public function rates()
   {
       return $this->hasMany(Rate::class);
   }

   public function orders()
   {
       return $this->hasMany(Order::class);
   }

   public function carts()
   {
       return $this->hasMany(Cart::class);
   }

   public function reservations()
   {
       return $this->hasMany(Reservation::class);
   }

   public function invitions()
   {
       return $this->hasMany(Invite::class);
   }
   
}
