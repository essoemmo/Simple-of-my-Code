<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sex extends Model
{
    use HasFactory;

    protected $table = 'sexes';

    protected $fillable = [
        'title_ar',
        'title_en',
    ];

    protected $hidden = [
        'title_ar',
        'title_en',
        'created_at',
        'updated_at',
    ];

    protected $appends = ['title'];
    
    public function getTitleAttribute()
    {
        return $this->{'title_'. app()->getLocale()};
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
