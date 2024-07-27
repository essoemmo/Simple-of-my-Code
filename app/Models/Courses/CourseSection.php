<?php

namespace App\Models\Courses;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseSection extends Model
{
    use SoftDeletes;

    protected $table = 'course_sections';

    public $timestamps = true;

    protected array $dates = ['deleted_at'];

    protected $fillable = ['course_id', 'section_id'];

    protected $hidden = ['create_at', 'updated_at', 'deleted_at'];
}
