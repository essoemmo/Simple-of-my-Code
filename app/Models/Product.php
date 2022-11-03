<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'price',
        'qty',
        'total',
        'purchase_id',
        'order_id',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class , 'order_id');
    }
}
