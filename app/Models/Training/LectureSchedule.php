<?php

namespace App\Models\Training;

use App\Traits\HasAttachmentTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class LectureSchedule extends Model
{
    use SoftDeletes;
    use HasAttachmentTrait;
   // use filterable;

    protected $table = 'lecture_schedules';

    protected $fillable = ['name', 'status'];

    public $timestamps = true;

    protected array $dates = ['deleted_at'];

    protected $hidden = ['create_at', 'updated_at', 'deleted_at'];

    protected $casts = [

    ];

    public function mandatoryLectures(): BelongsToMany
    {
        return $this->belongsToMany(
            MandatoryLecture::class,
            'schedules_mandatory_lectures',
            'lecture_schedule_id',
            'mandatory_lecture_id'
        );
    }

}
