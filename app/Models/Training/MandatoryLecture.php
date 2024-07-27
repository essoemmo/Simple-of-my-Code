<?php

namespace App\Models\Training;

use App\Models\Courses\Course;
use App\Models\Management\Department;
use App\Models\Users\User;
use App\Traits\HasAttachmentTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class MandatoryLecture extends Model
{
    use SoftDeletes;
    use HasAttachmentTrait;

    protected $table = 'mandatory_lectures';

    protected $fillable = ['course_id', 'department_id', 'location', 'percentage'];

    public $timestamps = true;

    protected array $dates = ['deleted_at'];

    protected $hidden = ['create_at', 'updated_at', 'deleted_at'];

    protected $casts = [
    ];

    /**
     * @return BelongsTo
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function times(): HasMany
    {
        return $this->hasMany(MandatoryLectureTime::class, 'mandatory_lecture_id',);
    }

    public function lectureSchedules(): BelongsToMany
    {
        return $this->belongsToMany(
            LectureSchedule::class,
            'schedules_mandatory_lectures',
            'mandatory_lecture_id',
            'lecture_schedule_id'
        );
    }

}
