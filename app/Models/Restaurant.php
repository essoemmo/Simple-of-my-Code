<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Restaurant extends Authenticatable
{
    use HasFactory,HasApiTokens,Notifiable;

    protected $table = 'restaurants';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'isVerified',
        'google_token',
        'image',
        'cover',
        'code',
        'active',
        'lat',
        'lang',
        'address',
        'from',
        'to',
        'resrv_numb',
        'sets',
        'type_place_id',
        'fcm_token'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

   /**
     * Specifies the user's FCM token
     *
     * @return string|array
     */
    public function routeNotificationForFcm()
    {
        return $this->google_token;
    }

    public function scopeIsWithinMaxDistance($query, $lang , $lat, $radius = 25) {
        $haversine = "(6371 * acos(cos(radians(".$lat.")) 
                        * cos(radians(restaurants.lat)) 
                        * cos(radians(restaurants.lang) 
                        - radians($lang)) 
                        + sin(radians($lat)) 
                        * sin(radians(restaurants.lat))))";
        return $query
           ->select('restaurants.*')
           ->selectRaw("{$haversine} AS distance");
   }


   public function amenities()
   {
       return $this->belongsToMany(Amenity::class,'restaurant_aminities','restaurant_id','amenity_id');
   }

   public function categories()
   {
       return $this->hasMany(Category::class);
   }

   public function products()
   {
       return $this->hasMany(Product::class);
   }

   public function rates()
   {
       return $this->hasMany(Rate::class);
   }

   public function orders()
   {
       return $this->hasMany(Order::class);
   }

   public function banners()
   {
       return $this->hasOne(Banner::class);
   }

   public function photos()
   {
       return $this->morphMany(Photo::class,'photoable');
   }

}
