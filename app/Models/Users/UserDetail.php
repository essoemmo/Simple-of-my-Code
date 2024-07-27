<?php

namespace App\Models\Users;

use App\Enums\Options\GenderEnum;
use App\Traits\HasAttachmentTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDetail extends Model
{
    use HasAttachmentTrait;
    use SoftDeletes;

    protected $table = 'user_details';

    protected $fillable = [
        'user_id',
        'id_number',
        'gender',
        'qualifications',
        'age',
        'description',
        'status',
        'employee_number',
        'birth_date',
        'job_type',
        'address',
        ];

    public $timestamps = true;

    protected array $dates = ['deleted_at'];

    protected $hidden = ['create_at', 'updated_at', 'deleted_at'];

    protected $casts = [
        'gender' => GenderEnum::class,
    ];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
