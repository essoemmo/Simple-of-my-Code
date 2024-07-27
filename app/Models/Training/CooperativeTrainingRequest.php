<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CooperativeTrainingRequest extends Model
{
    use SoftDeletes;

    protected $table = 'cooperative_training_requests';

    protected $fillable = ['user_id', 'department_id', 'cooperative_training_id', 'status', 'status_reason', 'start_date', 'end_date'];

    public $timestamps = true;

    protected array $dates = ['deleted_at'];

    protected $hidden = ['create_at', 'updated_at', 'deleted_at'];

    protected $casts = [
    ];
}
