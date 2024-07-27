<?php

namespace App\Models\Courses;

use App\Enums\Courses\CourseLanguageEnum;
use App\Enums\Courses\CourseLevelEnum;
use App\Enums\Courses\CourseStatusEnum;
use App\Enums\Courses\CourseTypeEnum;
use App\Enums\Courses\VideoHostingEnum;
use App\Models\Users\User;
use App\Models\Web\Favorite;
use App\Models\Web\Review;
use App\Traits\Filterable;
use App\Traits\HasAttachmentTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;


class Course extends Model
{
    use HasAttachmentTrait;
    use SoftDeletes;
    use Filterable;

    protected $table = 'courses';

    protected $fillable = [
        'main_section_id', 'sub_section_id', 'instructor_id',
        'name_ar', 'name_en', 'video_hosting', 'intro_video_url', 'intro_video_file',
        'description_ar', 'description_en', 'requirements_ar', 'requirements_en',
        'type', 'language', 'location', 'is_free', 'price', 'discount_price',
        'level', 'duration_ar', 'duration_en', 'keywords', 'meta_description', 'status'
    ];

    protected array $filterableColumns = [
        'name_ar' => 'like',
        'name_en' => 'like',
        'main_section_id' => 'equals',
        'sub_section_id' => 'equals',
        'status' => 'equals',
        'level' => 'equals',
        'instructor_id' => 'equals',
        'type' => 'equals',
//        'city_id' => 'relation' // Assuming city is a relation via branch
    ];

    protected $with = ['attachments'];

    protected $appends = ['name', 'description', 'requirements', 'duration', 'filterableColumns'];

    public $timestamps = true;

    protected array $dates = ['deleted_at'];

    protected $hidden = ['create_at', 'updated_at', 'deleted_at'];

    protected $casts = [
        'type' => CourseTypeEnum::class,
        'status' => CourseStatusEnum::class,
        'level' => CourseLevelEnum::class,
        'language' => CourseLanguageEnum::class,
        'video_hosting' => VideoHostingEnum::class
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

    public function duration(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->{'duration_' . app()->getLocale()}
        );
    }

    public function requirements(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->{'requirements_' . app()->getLocale()}
        );
    }

    // relations

    public function instructor(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'instructor_id');
    }

    public function mainSection(): BelongsTo
    {
        return $this->belongsTo(Section::class, 'main_section_id');
    }

    public function subSection(): BelongsTo
    {
        return $this->belongsTo(Section::class, 'sub_section_id');
    }

    public function chapters(): BelongsToMany
    {
        return $this->belongsToMany(Chapter::class, 'course_chapters');
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }

    public function favorite(): MorphMany
    {
        return $this->MorphMany(Favorite::class, 'favorable');
    }

    public function review(): MorphMany
    {
        return $this->MorphMany(Review::class, 'reviewable');
    }
}
