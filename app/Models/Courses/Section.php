<?php

namespace App\Models\Courses;

use App\Enums\Options\ActiveEnum;
use App\Traits\Filterable;
use App\Traits\HasAttachmentTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use HasAttachmentTrait;
    use SoftDeletes;
    use Filterable;

    protected $table = 'sections';

    public $timestamps = true;

    protected $with = ['sections','attachments'];

    protected array $filterableColumns = [
        'name_ar' => 'like',
        'name_en' => 'like',
        'status' => 'equals',
        'parent_id' => 'equals',
    ];

    protected array $dates = ['deleted_at'];

    protected $fillable = ['parent_id', 'name_ar', 'name_en', 'description_ar', 'description_en', 'status'];

    protected $appends = ['name', 'description'];

    protected $hidden = ['create_at', 'updated_at', 'deleted_at'];

    protected $casts = [
        'status' => ActiveEnum::class,
    ];

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

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class, 'parent_id');
    }

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class, 'parent_id');
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class, 'main_section_id');
    }
}
