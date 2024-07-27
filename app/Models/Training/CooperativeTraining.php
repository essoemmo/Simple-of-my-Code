<?php

namespace App\Models\Training;

use App\Enums\Options\StatusEnum;
use App\Models\Departments\Department;
use App\Models\Users\User;
use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CooperativeTraining extends Model
{
    use SoftDeletes;
    use Filterable;

    protected $table = 'cooperative_trainings';

    protected $fillable = ['user_id', 'department_id', 'status', 'refuse_reason', 'start_date', 'end_date'];

    protected array $filterableColumns = [
       'department_id' => 'equals',
       'status' => 'equals',
    ];

    public $timestamps = true;

    protected array $dates = ['deleted_at'];

    protected $hidden = ['create_at', 'updated_at', 'deleted_at'];

    protected $casts = [
        'status' => StatusEnum::class,
    ];

    protected $with = ['attachments'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

}
