<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'order_details';

    protected $fillable = [
        'order_id',
        'restaurant_id',
        'product_id',
        'type_id',
        'qty',
        'sub_total',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'user_id',
        'restaurant_id',
        'product_id',
        'type_id',
    ];

    public function types()
    {
        return $this->belongsTo(Type::class,'type_id');
    }

}
