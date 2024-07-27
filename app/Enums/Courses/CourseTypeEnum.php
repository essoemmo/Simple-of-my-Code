<?php

namespace App\Enums\Courses;

enum CourseTypeEnum: int
{
    case recorded = 1;
    case live = 2;

    public function label(): string
    {
        return match ($this) {
            self::recorded => __('application.recorded'),
            self::live => __('application.live'),
        };
    }
}
