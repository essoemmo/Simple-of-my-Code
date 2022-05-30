<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypePlace extends Model
{
    use HasFactory;
    
    protected $table = 'type_places';

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
}
