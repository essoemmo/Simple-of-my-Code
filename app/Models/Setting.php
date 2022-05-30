<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable = [
        'logo',
        'facebook',
        'instagram',
        'twitter',
        'phone',
        'whatsapp',
        'email',
        'address',
        'description_ar',
        'description_en',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $appends = ['description'];

    
    public function getDescriptionAttribute()
    {
        return $this->{'description_'. app()->getLocale()};
    }
    
}
