<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'manager_name',
        'manager_phone',
        'commercial',
        'email',
        'password',
        'sex_id',
        'birthday',
        'phone',
        'id_number',
        'is_verified',
        'google_token',
        'image',
        'code',
        'active',
        'description',
        'blood_type',
        'language_id',
        'type_id',
        'relation_id',
        'national_id',
        'city_id',
        'user_id',
        'balance',
        'national_address',
        'is_draw',
    ];


    protected $hidden = [
        'password',
        'remember_token',
        'google_token',
        'created_at',
        'updated_at',
        'email_verified_at'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function national()
    {
        return $this->belongsTo(National::class);
    }

    public function relation()
    {
        return $this->belongsTo(Relation::class);
    }

    public function language()
    {
        return $this->belongsTo(Langauage::class , 'language_id');
    }
    
    public function sex()
    {
        return $this->belongsTo(Sex::class , 'sex_id');
    }
    
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function organization()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function parent()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function userScans()
    {
        return $this->hasMany(Scan::class , 'user_id');
    }

    public function kidScans()
    {
        return $this->hasMany(Scan::class , 'kid_id');
    }

    public function kids()
    {
        return $this->hasMany(User::class , 'user_id');
    }

    public function charges()
    {
        return $this->hasMany(Recharge::class , 'user_id');
    }

    public function kidCharges()
    {
        return $this->hasMany(Recharge::class , 'kid_id');
    }

    public function kidOrders()
    {
        return $this->hasMany(Order::class , 'kid_id');
    }

    public function sellerOrders()
    {
        return $this->hasMany(Order::class , 'user_id');
    }

    public function accounts()
    {
        return $this->hasOne(Account::class , 'user_id');
    }
}
