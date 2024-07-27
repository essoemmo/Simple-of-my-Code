<?php

namespace App\Enums\Courses;

enum QuestionEnum: int
{
    case mcq = 1;
    case multi_select = 2;
    case match = 3;
    case order = 4;

    public function label(): string
    {
        return match ($this) {
            self::mcq => __('application.mcq'),
            self::multi_select => __('application.multi_select'),
            self::match => __('application.match'),
            self::order => __('application.order'),
        };
    }
}
