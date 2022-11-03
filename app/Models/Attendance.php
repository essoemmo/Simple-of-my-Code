<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendances';

    protected $fillable = [
        'kid_id',
        'user_id',
        'check_in',
        'check_out',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function kid()
    {
        return $this->belongsTo(User::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
