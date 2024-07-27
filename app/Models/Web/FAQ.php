<?php

namespace App\Models\Web;

use App\Traits\Filterable;
use App\Traits\HasAttachmentTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;

class FAQ extends Model
{
    use HasAttachmentTrait;

    use SoftDeletes;

    use Filterable;

    protected $table = 'f_a_qs';
    public $timestamps = true;

    protected array $dates = ['deleted_at'];

    protected $hidden = ['create_at', 'updated_at', 'deleted_at'];

    protected $appends = ['question', 'answer'];

    public function question(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->{'question_' . app()->getLocale()}
        );
    }

    public function answer(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->{'answer_' . app()->getLocale()}
        );
    }


    protected $fillable = [
        'question_ar',
        'answer_ar',
        'question_en',
        'answer_en',
    ];

    protected array $filterableColumns = [
        'question' => 'like',
        'answer' => 'like',
    ];
}
