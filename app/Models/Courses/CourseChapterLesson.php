<?php

namespace App\Models\Courses;

use App\Traits\HasAttachmentTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseChapterLesson extends Model
{
    use HasAttachmentTrait;
    use SoftDeletes;

    protected $table = 'course_chapter_lesson';
    public $timestamps = true;
    protected array $dates = ['deleted_at'];
    protected $fillable = ['chapter_id', 'lesson_id', "course_id"];
    protected $hidden = ['create_at', 'updated_at', 'deleted_at'];
    protected $casts = [
    ];
}
