<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class MandatoryLectureTime extends Model
{
    use SoftDeletes;

    protected $table = 'mandatory_lecture_times';

    protected $fillable = [
        'mandatory_lecture_id',
        'time',
        'date',
    ];

    public $timestamps = true;

    protected array $dates = ['deleted_at'];

    protected $hidden = ['create_at', 'updated_at', 'deleted_at'];

    protected $casts = [

    ];


    public function mandatoryLecture(): BelongsTo
    {
        return $this->belongsTo(MandatoryLecture::class);
    }
}
