<?php

namespace Web;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enrollment extends Model
{
    protected $table = 'enrollments';

    public $timestamps = true;

    use HasAttachmentTrait;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['user_id'];

    protected $hidden = ['create_at', 'updated_at', 'deleted_at'];

    protected $casts = [
    ];
}
