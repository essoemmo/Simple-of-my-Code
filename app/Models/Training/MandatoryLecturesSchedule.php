<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MandatoryLecturesSchedule extends Model
{
    use SoftDeletes;

    protected $table = 'schedules_mandatory_lectures';

    protected $fillable = ['lecture_schedule_id', 'mandatory_lecture_id'];

    public $timestamps = true;

    protected array $dates = ['deleted_at'];

    protected $hidden = ['create_at', 'updated_at', 'deleted_at'];

    protected $casts = [
    ];

}
