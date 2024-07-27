<?php

namespace App\Models\Exams;

use App\Enums\Options\ActiveEnum;
use App\Traits\Filterable;
use App\Traits\HasAttachmentTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
    use HasAttachmentTrait;
    use SoftDeletes;
    use Filterable;


    protected $table = 'exams';

    public $timestamps = true;

    protected array $dates = ['deleted_at'];

    protected $fillable = [
        'chapter_id',
        'name_ar',
        'name_en',
        'instructions',
        'min_passing_grade',
        'random_questions',
        'num_random_questions',
        'status',
    ];
    protected array $filterableColumns = [
        'name_ar' => 'like',
        'name_en' => 'like',
    ];
    protected $hidden = ['create_at', 'updated_at', 'deleted_at'];

    protected $casts = [
        'status' => ActiveEnum::class,
    ];

    public function Certificate(): HasOne
    {
        return $this->hasOne(certificate::class);
    }
}
