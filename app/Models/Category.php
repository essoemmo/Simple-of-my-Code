<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    protected $table = 'categories';

    protected $fillable = [
        'restaurant_id',
        'title_ar',
        'title_en',
        'active'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'title_ar',
        'title_en',
        'active',
        'restaurant_id'
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

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
