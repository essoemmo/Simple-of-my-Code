<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';

    protected $fillable = [
        'user_id',
        'restaurant_id',
        'product_id',
        'type_id',
        'qty',
        'sub_total',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];


   public function users()
   {
       return $this->belongsTo(User::class,'user_id');
   }

   public function products()
   {
       return $this->belongsTo(Product::class,'product_id');
   }

   public function types()
   {
       return $this->belongsTo(Type::class,'type_id');
   }

   public function restaurants()
   {
       return $this->belongsTo(Restaurant::class,'restaurant_id');
   }


}
