<?php

namespace App\Models\Courses;

use App\Traits\HasAttachmentTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseChapter extends Model
{
    use HasAttachmentTrait;
    use SoftDeletes;

    protected $table = 'course_chapters';

    public $timestamps = true;

    protected array $dates = ['deleted_at'];

    protected $fillable = ['chapter_id', "course_id"];

    protected $hidden = ['create_at', 'updated_at', 'deleted_at'];

    protected $casts = [
    ];
}
