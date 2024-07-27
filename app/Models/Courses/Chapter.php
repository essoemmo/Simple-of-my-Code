<?php

namespace App\Models\Courses;

use App\Enums\Options\StatusEnum;
use App\Models\Exams\Exam;
use App\Traits\Filterable;
use App\Traits\HasAttachmentTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chapter extends Model
{
    use HasAttachmentTrait;
    use SoftDeletes;
    use Filterable;

    protected $table = 'chapters';

    protected $fillable = ['name_ar', 'name_en', 'status'];

    protected array $filterableColumns = [
        'name_ar' => 'like',
        'name_en' => 'like',
        'status' => 'equals',
    ];

    protected $appends = ['name'];

    protected array $dates = ['deleted_at'];

    public $timestamps = true;

    protected $hidden = ['create_at', 'updated_at', 'deleted_at'];

    protected $casts = [
        'status' => StatusEnum::class,
    ];

    public function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->{'name_'.app()->getLocale()}
        );
    }

    // relations phase 1

    public function exam(): HasOne
    {
        return $this->hasOne(Exam::class);
    }

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_chapters');
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }
}
