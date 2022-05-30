<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    use HasFactory;

    protected $table = 'amenities';

    protected $fillable = [
        'title_ar',
        'title_en',
        'image',
        'active',
    ];

    protected $hidden = [
        'title_ar',
        'title_en',
        'created_at',
        'updated_at',
        'active',
    ];

    protected $appends = ['title'];
    
    public function getTitleAttribute()
    {
        return $this->{'title_'. app()->getLocale()};
    }

    public function restaurants()
    {
        return $this->belongsTo(Restaurant::class,'restaurant_id');
    }

}
