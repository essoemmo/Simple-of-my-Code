<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $guarded = [];
    
 

    public function kid()
    {
        return $this->belongsTo(User::class , 'kid_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
   

    public function products()
    {
        return $this->hasMany(Product::class , 'order_id');
    }
}
