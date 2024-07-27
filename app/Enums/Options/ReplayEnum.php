<?php

namespace App\Enums\Options;

enum ReplayEnum: int
{
    case accept = 1;
    case refuse = 2;


    public function label(): string
    {
        return match ($this) {
            self::accept => __('application.accept'),
            self::refuse => __('application.refuse'),

        };
    }
}
