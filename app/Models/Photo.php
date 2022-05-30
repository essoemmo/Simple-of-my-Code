<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $table = 'photos';

    protected $fillable = [
        'image',
        'photoable_id',
        'photoable_type',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'photoable_id',
        'photoable_type',
    ];

    public function photoable()
    {
      return $this->morphTo();
    }


}
