<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservations';

    protected $fillable = [
        'user_id',
        'restaurant_id',
        'order_status_id',
        'date',
        'time',
        'sets',
        'note',
        'type_place_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'user_id',
        'restaurant_id',
        'order_status_id',
    ];

    

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function restaurants()
    {
        return $this->belongsTo(Restaurant::class,'restaurant_id');
    }

    public function typeplaces()
    {
        return $this->belongsTo(TypePlace::class,'type_place_id');
    }

    public function status()
    {
        return $this->belongsTo(OrderStatus::class,'order_status_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function invitions()
    {
        return $this->hasMany(Invite::class);
    }

    

}
