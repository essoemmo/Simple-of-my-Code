<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $table = 'coupons';

    protected $fillable = ['code','from','to','precent'];

    protected $hidden = [
        'created_at',
        'updated_at',
        'active'
    ];
}
