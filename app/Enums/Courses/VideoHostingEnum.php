<?php

namespace App\Enums\Courses;

enum VideoHostingEnum: int
{
    case youtube = 1;
    case vimeo = 2;

    public function label(): string
    {
        return match ($this) {
            self::youtube => __('application.youtube'),
            self::vimeo => __('application.vimeo'),
        };
    }
}
