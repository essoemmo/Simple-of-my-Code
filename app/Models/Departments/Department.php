<?php

namespace App\Models\Departments;

use App\Enums\Options\ActiveEnum;
use App\Models\Training\CooperativeTraining;
use App\Models\Users\Admin;
use App\Models\Users\User;
use App\Traits\Filterable;
use App\Traits\HasAttachmentTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasAttachmentTrait;
    use SoftDeletes;
    use Filterable;

    protected $table = 'departments';

    public $timestamps = true;

    protected array $dates = ['deleted_at'];

    protected $fillable = ['parent_id', 'name_ar', 'name_en', 'available_seats', 'description_ar', 'description_en', 'status'];

    protected array $filterableColumns = [
        'name_ar' => 'like',
        'name_en' => 'like',
        'parent_id' => 'equals',
    ];
    protected $appends = ['name', 'description'];

    protected $hidden = ['create_at', 'updated_at', 'deleted_at'];

    protected $casts = [
        'status' => ActiveEnum::class,
    ];

    protected $with = ['departments'];

    public function name(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->{'name_' . app()->getLocale()}
        );
    }

    public function description(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->{'description_' . app()->getLocale()}
        );
    }

    public function scopeAvailableSeats($query)
    {
        return $query->where('available_seats', '>', 0);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'parent_id');
    }

    public function departments(): HasMany
    {
        return $this->hasMany(Department::class, 'parent_id');
    }

    public function users(): HasMany
    {
        return $this->HasMany(User::class);
    }

    public function admins(): HasMany
    {
        return $this->HasMany(Admin::class);
    }

    public function cooperativeTrainings(): HasMany
    {
        return $this->hasMany(CooperativeTraining::class);
    }
}
