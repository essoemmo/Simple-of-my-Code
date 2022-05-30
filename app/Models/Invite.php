<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    use HasFactory;

    protected $table = 'invites';

    protected $fillable = [
        'user_id',
        'reservation_id',
        'status'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'user_id',
        'reservation_id',
        'status'
    ];

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function reservations()
    {
        return $this->belongsTo(Reservation::class,'reservation_id');
    }
}
