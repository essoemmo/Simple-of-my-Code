<?php

namespace App\Enums\Users;

enum JobTypeEnum: int
{
    case PreparationOrTest = 1;
    case Contract = 2;
    case FullTime = 3;
    case PartTime = 4;

    public function label(): string
    {
        return match ($this) {
            self::PreparationOrTest => __('application.PreparationOrTest'),
            self::Contract => __('application.Contract'),
            self::FullTime => __('application.FullTime'),
            self::PartTime => __('application.PartTime'),

        };
    }
}
