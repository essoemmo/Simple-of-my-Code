<?php

namespace App\Enums\Options;

enum ChoiceEnum: int
{
    case yes = 1;
    case no = 2;


    public function label(): string
    {
        return match ($this) {
            self::yes => __('application.yes'),
            self::no => __('application.no'),
        };
    }
}
