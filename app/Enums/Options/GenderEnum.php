<?php

namespace App\Enums\Options;

enum GenderEnum: int
{
    case female = 2;
    case male = 1;

    public function label(): string
    {
        return match ($this) {
            self::female => __('application.female'),
            self::male => __('application.male'),
        };
    }

}
