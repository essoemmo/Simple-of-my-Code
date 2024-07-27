<?php

namespace App\Models\training;

use App\Traits\HasAttachmentTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrainingNeed extends Model
{
    use HasAttachmentTrait;
    use SoftDeletes;

    protected $table = 'training_needs';

    public $timestamps = true;

    protected array $dates = ['deleted_at'];

    protected $fillable = ['course_id', 'department_id', 'status', 'date_sent'];

    protected $hidden = ['create_at', 'updated_at', 'deleted_at'];

    protected $casts = [
    ];
}
