<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantAminity extends Model
{
    use HasFactory;

    protected $table = 'restaurant_aminities';

    protected $fillable = [
        'restaurant_id',
        'amenity_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

}
