<?php

namespace App\Enums\Users;

enum UserTypeEnum: int
{
    case instructor = 1;
    case student = 2;

    public function label(): string
    {
        return match ($this) {
            self::instructor => __('application.instructor'),
            self::student => __('application.student'),
        };
    }
}
