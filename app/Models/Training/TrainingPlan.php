<?php

namespace App\Models\training;

namespace App\Models\training;

use App\Traits\HasAttachmentTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrainingPlan extends Model
{
    use HasAttachmentTrait;
    use SoftDeletes;

    protected $table = 'training_plans';

    protected $fillable = ['course_id', 'date', 'type', 'status', 'location', 'required_employees', 'date_sent'];

    public $timestamps = true;

    protected array $dates = ['deleted_at'];

    protected $hidden = ['create_at', 'updated_at', 'deleted_at'];

    protected $casts = [
    ];
}
