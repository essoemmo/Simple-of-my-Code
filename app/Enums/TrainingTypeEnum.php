<?php

namespace App\Enums;

enum TrainingTypeEnum:int
{
    case internal = 1;

    case external = 2;

    public function label(): string
    {
        return match ($this) {
            self::internal => __('application.internal'),
            self::external => __('application.external'),
        };
    }

}
