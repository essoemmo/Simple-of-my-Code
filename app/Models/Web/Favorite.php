<?php

namespace App\Models\Web;

use App\Traits\HasAttachmentTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Favorite extends Model
{
  //  use SoftDeletes;
    protected $table = 'favorites';

    public $timestamps = true;

    protected array $dates = ['deleted_at'];

    protected $guarded = [];

    protected $hidden = ['create_at', 'updated_at', 'deleted_at'];

    protected $casts = [
    ];

    public function favorable():MorphTo
    {
        return $this->morphTo();
    }

    public function scopeCourses($query): void
    {
        $query->where('favorable_type','App\Models\Courses\Course');
    }

    public function scopeInstructors($query): void
    {
        $query->where('favorable_type','App\Models\Users\User');
    }

}
