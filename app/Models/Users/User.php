<?php

namespace App\Models\Users;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\Options\ActiveEnum;
use App\Enums\Users\UserTypeEnum;
use App\Models\Courses\Course;
use App\Models\Settings\Nationality;
use App\Models\Token;
use App\Models\Web\Favorite;
use App\Models\Web\Review;
use App\Traits\Filterable;
use App\Traits\HasAttachmentTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasAttachmentTrait;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;
    use Filterable;

    protected $fillable = [
        'department_id',
        'name',
        'phone',
        'email',
        'type',
        'status',
        'refuse_reason',
        'nationality_id',
        'email_verified_at',
        'code',
        'password',
        'is_verified',
        'is_active',
        'is_deleted',
        'age',
    ];
    protected array $filterableColumns = [
        'name' => 'like',
        'email' => 'equals',
        'phone' => 'equals',
        'status' => 'equals',
        //'start_date' => 'equals',
        //'end_date' => 'equals',

    ];
    protected $with = ['userDetail','attachments'];

    protected array $dates = ['deleted_at'];

    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'created_at', 'updated_at', 'deleted_at',
    ];

    protected $casts = [
        'status' => ActiveEnum::class,
        'type' => UserTypeEnum::class,
    ];

    //user Types Scopes

    public function scopeStudent($query)
    {
        return $query->where('type', UserTypeEnum::student->value);
    }

    public function scopeInstructor($query)
    {
        return $query->where('type', UserTypeEnum::instructor->value);
    }

    public function scopeByEmail($query, $email)
    {
        return $query->where('email', $email);
    }
    public function scopeByEmailAndToken($query, $email, $code)
    {
        return $query->where('email', $email)
            ->where('code',  $code);
    }

    public function userDetail(): HasOne
    {
        return $this->hasOne(UserDetail::class);
    }

    public function nationality(): BelongsTo
    {
        return $this->belongsTo(Nationality::class);
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class,'instructor_id',);
    }
    public function favorite(): MorphMany
    {
        return $this->morphMany(Favorite::class, 'favorable');
    }
    public function review(): MorphMany
    {
        return $this->MorphMany(Review::class, 'reviewable');
    }

    public function fcmTokens(): MorphMany
    {
        return $this->morphMany(Token::class, 'tokenable');
    }
}
