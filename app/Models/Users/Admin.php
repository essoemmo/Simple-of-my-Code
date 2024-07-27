<?php

namespace App\Models\Users;

use App\Enums\Options\GenderEnum;
use App\Enums\Options\StatusEnum;
use App\Enums\Users\JobTypeEnum;
use App\Models\Departments\Department;
use App\Models\Settings\Nationality;
use App\Models\Token;
use App\Traits\Filterable;
use App\Traits\HasAttachmentTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\HasRolesAndPermissions;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable implements MustVerifyEmail
{
    use HasRolesAndPermissions;
    use Notifiable;
    use SoftDeletes;
    use Filterable;
    use HasAttachmentTrait;
    use HasApiTokens;


    //public mixed $access_token;

    protected $table = 'admins';

    protected $fillable = [
        'department_id',
        'name',
        'email',
        'phone',
        'password',
        'birth_date',
        'join_date',
        'description',
        'address',
        'gender',
        'qualifications',
        'age',
        'salary',
        'status',
        'whatsapp',
        'refuse_reason',
        'nationality_id',
        'id_number',
        'job_type',
        'employee_number',
        'code',
        'is_verified',
        'is_deleted'

    ];

    protected array $filterableColumns = [
        'name' => 'like',
        'department_id' => 'equals',
        'status' => 'equals',
    ];

    protected array $dates = ['deleted_at'];

    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
    ];

    public function phone(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value !== null
                ? match (true) {
                    request()->header('Accept-Language') === 'ar' => '+'.'966'.$value,
                    app()->getLocale() === 'ar' => '966'.$value.'+',
                    default => '+966'.$value,
                }
                : null
        );
    }

    protected $casts = [
        'email_verified_at' => 'datetime',
        'status' => StatusEnum::class,
        'job_type' => JobTypeEnum::class,
        'gender' => GenderEnum::class
    ];

    protected $with = ['roles', 'attachments'];

    public function scopeWithoutSuperAdmin($query)
    {
        return $query->whereHas('roles', function ($query) {
            $query->where('name', '!=', 'super_admin');
        });
    }

    public function scopeByRole($query, $role_id)
    {
        return $query->whereHas('roles', function ($q) use ($role_id) {
            $q->where('role_id', '=', $role_id);
        });
    }
    public function scopeAdminSearch($query, Request $request): void
    {
        $query->when($request->has('role_id'), function ($query) use ($request) {
            $query->byRole($request->input('role_id'));
        });
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
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function nationality(): BelongsTo
    {
        return $this->belongsTo(Nationality::class);
    }

    public function fcmTokens(): MorphMany
    {
        return $this->morphMany(Token::class, 'tokenable');
    }


}
