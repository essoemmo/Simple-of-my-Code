<?php

namespace App\Enums\Courses;

enum CourseLanguageEnum: int
{
    case ar = 1;
    case en = 2;

    public function label(): string
    {
        return match ($this) {
            self::ar => __('application.arabic'),
            self::en => __('application.english'),
        };
    }
}
