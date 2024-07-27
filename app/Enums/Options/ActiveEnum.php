<?php

namespace App\Enums\Options;

enum ActiveEnum : int
{
    case inactive = 2;

    case active = 1;

    public function label(): string
    {
        return match ($this) {
            self::active => __('application.active'),
            self::inactive => __('application.inactive'),
        };
    }

}
