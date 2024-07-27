<?php

namespace Training;

use App\Traits\HasAttachmentTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nomination extends Model
{
    use HasAttachmentTrait;
    use SoftDeletes;

    protected $table = 'nominations';

    protected $fillable = ['course_id', 'user_id', 'department_id', 'status', 'date_sent'];

    public $timestamps = true;

    protected array $dates = ['deleted_at'];

    protected $hidden = ['create_at', 'updated_at', 'deleted_at'];

    protected $casts = [
    ];
}
