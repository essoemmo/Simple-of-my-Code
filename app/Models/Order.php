<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'restaurant_id',
        'reservation_id',
        'order_status_id',
        'order_type_id',
        'coupon_id',
        'type',
        'date',
        'time',
        'type_place_id',
        'note',
        'sub_total',
        'table_number',
        'discount',
        'total',
        'pay_type'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'user_id',
        'restaurant_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
 
    public function products()
    {
        return $this->belongsToMany(Product::class,'order_details','order_id','product_id')->withPivot('qty','type_id','sub_total');
    }
 
    public function status()
    {
        return $this->belongsTo(OrderStatus::class,'order_status_id');
    }

    public function types()
    {
        return $this->belongsTo(OrderType::class,'order_type_id');
    }

    public function typeplaces()
    {
        return $this->belongsTo(TypePlace::class,'type_place_id');
    }
 
    public function restaurants()
    {
        return $this->belongsTo(Restaurant::class,'restaurant_id');
    }

    public function reservations()
    {
        return $this->belongsTo(Reservation::class,'reservation_id');
    }


}
