<?php

namespace App\Enums\Courses;

enum CourseStatusEnum: int
{
    case pending = 1;
    case published = 2;
    case inactive = 3;
    case rejected = 4;

    public function label(): string
    {
        return match ($this) {
            self::pending => __('application.pending'),
            self::published => __('application.published'),
            self::inactive => __('application.inactive'),
            self::rejected => __('application.rejected'),
        };
    }
}
