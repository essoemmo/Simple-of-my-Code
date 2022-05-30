<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'restaurant_id',
        'category_id',
        'title_ar',
        'title_en',
        'short_desc_ar',
        'short_desc_en',
        'description_ar',
        'description_en',
        'active',
        'image',
        'main_price'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'title_ar',
        'title_en',
        'description_ar',
        'description_en',
        'short_desc_ar',
        'short_desc_en',
    ];

    protected $appends = ['description','title','short_desc'];

    
    public function getDescriptionAttribute()
    {
        return $this->{'description_'. app()->getLocale()};
    }

    public function getTitleAttribute()
    {
        return $this->{'title_'. app()->getLocale()};
    }

    public function getShortDescAttribute()
    {
        return $this->{'short_desc_'. app()->getLocale()};
    }

    public function restaurants()
    {
        return $this->belongsTo(Restaurant::class,'restaurant_id');
    }

    public function categories()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function types()
    {
        return $this->hasMany(Type::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class,'order_details','product_id','order_id')->withPivot('qty','type_id','sub_total');
    }

}
