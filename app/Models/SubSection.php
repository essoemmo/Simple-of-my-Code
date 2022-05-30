<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSection extends Model
{
    use HasFactory;

    protected $table = 'sub_sections';

    protected $fillable = [
        'section_id',
        'title_ar',
        'title_en',
        'description_ar', 
        'description_en',
        'image'
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

    public function sections()
    {
        return $this->belongsTo(Section::class);
    }

}
