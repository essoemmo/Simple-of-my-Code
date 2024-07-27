<?php

namespace App\Models\Exams;

use App\Enums\Courses\QuestionEnum;
use App\Traits\HasAttachmentTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasAttachmentTrait;
    use SoftDeletes;

    protected $table = 'questions';

    public $timestamps = true;

    protected array $dates = ['deleted_at'];

    protected $fillable = ['exam_id', 'question_type', 'question_text', 'answer_text', 'explanation', 'correct_order'];

    protected $hidden = ['create_at', 'updated_at', 'deleted_at'];

    protected $casts = [
        'question_type' => QuestionEnum::class,
    ];
}
