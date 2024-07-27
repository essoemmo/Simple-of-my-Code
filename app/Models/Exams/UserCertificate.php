<?php

namespace App\Models\Exams;

use App\Traits\HasAttachmentTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserCertificate extends Model
{
    use HasAttachmentTrait;
    use SoftDeletes;

    protected $table = 'user_certificates';

    public $timestamps = true;

    protected array $dates = ['deleted_at'];

    protected $fillable = ['course_id', 'exam_id', 'user_id', 'issue_date', 'instructor_name'];

    protected $hidden = ['create_at', 'updated_at', 'deleted_at'];

    protected $casts = [
    ];
}
