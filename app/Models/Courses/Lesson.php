<?php

namespace App\Models\Courses;


use App\Enums\Options\ActiveEnum;
use App\Traits\Filterable;
use App\Traits\HasAttachmentTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    use HasAttachmentTrait;
    use SoftDeletes;
    use Filterable;

    protected $table = 'lessons';

    public $timestamps = true;

    protected array $dates = ['deleted_at'];

    protected $fillable = [
        'course_id',
        'chapter_id',
        'name_ar',
        'name_en',
        'video_hosting',
        'video_url',
        'video_file',
        'description_ar',
        'description_en',
        'status'
    ];

    protected array $filterableColumns = [
        'name_ar' => 'like',
        'name_en' => 'like',
        'status' => 'equals',
        'chapter_id' => 'equals',
        'course_id' => 'equals',
    ];

    protected $with = ['course', 'chapter'];
    protected $appends = ['name', 'description'];

    protected $hidden = ['create_at', 'updated_at', 'deleted_at'];

    protected $casts = [
        'status' => ActiveEnum::class
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

    // relations

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function chapter(): BelongsTo
    {
        return $this->belongsTo(Chapter::class);
    }
}
