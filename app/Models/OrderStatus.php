<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;

    protected $table = 'order_statuses';

    protected $fillable = [
        'title_ar',
        'title_en',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'title_ar',
        'title_en',
    ];

    protected $appends = ['title'];

    public function getTitleAttribute()
    {
        return $this->{'title_'. app()->getLocale()};
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
