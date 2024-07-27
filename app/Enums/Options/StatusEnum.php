<?php

namespace App\Enums\Options;

enum StatusEnum: int
{
    case pending = 1;

    case accepted = 2;

    case rejected = 3;

    public function label(): string
    {
        return match ($this) {
            self::pending => __('application.pending'),
            self::accepted => __('application.accepted'),
            self::rejected => __('application.rejected'),
        };
    }
}
