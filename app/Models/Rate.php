<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    protected $table = 'rates';

    protected $fillable = [
        'user_id',
        'restaurant_id',
        'stars',
        'review'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'user_id',
        'restaurant_id',
    ];


    public function restaurants()
    {
        return $this->belongsTo(Restaurant::class,'restaurant_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
