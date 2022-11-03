<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class National extends Model
{
    use HasFactory;

    protected $table = 'nationals';

    protected $fillable = [
        'title_ar',
        'title_en',
    ];

    protected $hidden = [
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
