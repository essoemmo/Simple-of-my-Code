<?php

namespace App\Models\Exams;

use App\Traits\HasAttachmentTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    use HasAttachmentTrait;
    use SoftDeletes;

    protected $table = 'answers';

    public $timestamps = true;

    protected array $dates = ['deleted_at'];

    protected $fillable = ['question_id', 'answer_text', 'explanation', 'is_correct'];

    protected $hidden = ['create_at', 'updated_at', 'deleted_at'];

    protected $casts = [
    ];
}
