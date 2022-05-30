<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usage extends Model
{
    use HasFactory;
    
    protected $table = 'usages';

    protected $fillable = [
        'description_ar',
        'description_en',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'description_ar',
        'description_en',
    ];

    protected $appends = ['description'];

    
    public function getDescriptionAttribute()
    {
        return $this->{'description_'. app()->getLocale()};
    }
}
