<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $table = 'faqs';

    protected $fillable = [
        'answer_ar',
        'answer_en',
        'question_ar',
        'question_en',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'answer_ar',
        'answer_en',
        'question_ar',
        'question_en',
    ];

    protected $appends = ['answer','question'];

    
    public function getAnswerAttribute()
    {
        return $this->{'answer_'. app()->getLocale()};
    }

    public function getQuestionAttribute()
    {
        return $this->{'question_'. app()->getLocale()};
    }
}
