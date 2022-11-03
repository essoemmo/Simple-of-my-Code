<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scan extends Model
{
    use HasFactory;

    protected $table = 'scans';

    protected $fillable = [
        'kid_id',
        'user_id',
        'lat',
        'lang',
        'type'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function kid()
    {
        return $this->belongsTo(User::class , 'kid_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }

    public function scopeDateFilter($query,$date)
    {
         return $query->whereIn('type' , ['attendance' , 'leave'])->whereDate('created_at' , '=' , Carbon::parse($date)->format('Y-m-d'))->latest();
    }


}
