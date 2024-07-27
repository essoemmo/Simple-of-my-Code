<?php

namespace App\Enums\Courses;

enum CourseLevelEnum: int
{
    case beginner = 1;
    case intermediate = 2;
    case advanced = 3;

    public function label(): string
    {
        return match ($this) {
            self::beginner => __('application.beginner'),
            self::intermediate => __('application.intermediate'),
            self::advanced => __('application.advanced'),
        };
    }
}
