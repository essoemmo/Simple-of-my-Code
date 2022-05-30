<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;

class Admin extends Authenticatable
{
    use LaratrustUserTrait;
    use HasFactory, Notifiable;

   protected $table = 'admins';

   protected $fillable = [
       'name',
       'email',
       'password',
       'active',
   ];

   protected $hidden = [
       'password',
       'remember_token',
   ];

   protected $casts = [
       'email_verified_at' => 'datetime',
   ];
}
