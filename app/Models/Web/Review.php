<?php

namespace App\Models\Web;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use SoftDeletes;

    protected $table = 'reviews';


    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'reviewable_type',
        'reviewable_id',
        'stars',
        'comment',
        'user_id',
    ];

    public function reviewable(): MorphTo
    {
        return $this->morphTo();
    }

    public function scopeCourses($query): void
    {
        $query->where('reviewable_type','App\Models\Courses\Course');
    }

    public function scopeInstructors($query): void
    {
        $query->where('reviewable_type','App\Models\Users\User');
    }
}
