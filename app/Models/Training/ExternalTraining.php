<?php

namespace App\Models\Training;

use App\Enums\Options\StatusEnum;
use App\Enums\TrainingTypeEnum;
use App\Models\Departments\Department;
use App\Models\Users\User;
use App\Traits\Filterable;
use App\Traits\HasAttachmentTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExternalTraining extends Model
{
    use HasAttachmentTrait;
    use SoftDeletes;
    use Filterable;

    protected $table = 'external_trainings';

    protected $fillable = [
        'user_id',
        'department_id',
        'course_name',
        'training_type',
        'status',
        'date_sent',
        'start_date',
        'end_date',
        'days',
        'time',
        'location',
        'training_benefit',
        'skills_training'
    ];

    protected array $filterableColumns = [
//        'user_id'=>'relation',
        'status' => 'equals',
        'created_at' => 'like'
    ];
    public $timestamps = true;

    protected array $dates = ['deleted_at'];

    protected $hidden = ['create_at', 'updated_at', 'deleted_at'];

    protected $casts = [
        'status' => StatusEnum::class,
        'training_type' => TrainingTypeEnum::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

}
