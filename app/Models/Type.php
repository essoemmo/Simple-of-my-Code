<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $table = 'types';

    protected $fillable = [
        'product_id',
        'title_ar',
        'title_en',
        'price',
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

    public function products()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function orderdetails()
    {
        return $this->hasOne(OrderDetail::class);
    }

}
