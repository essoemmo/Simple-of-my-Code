<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $table = 'sections';

    protected $fillable = [
        'title_ar',
        'title_en',
        'description_ar', 
        'description_en',
        'image',
        'type',
        'url',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $appends = ['description','title'];

    
    public function getDescriptionAttribute()
    {
        return $this->{'description_'. app()->getLocale()};
    }

    public function getTitleAttribute()
    {
        return $this->{'title_'. app()->getLocale()};
    }

    public function subsections()
    {
        return $this->hasMany(SubSection::class);
    }
}
