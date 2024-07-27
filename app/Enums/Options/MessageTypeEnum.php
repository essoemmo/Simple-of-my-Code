<?php

namespace App\Enums\Options;

enum MessageTypeEnum: int
{
    case request = 1;
    case suggestion = 2;
    case inquiry = 3;
    case complaint = 4;
    case other = 5;

    public function label(): string
    {
        return match ($this) {
            self::request => __('application.request'),
            self::suggestion => __('application.suggestion'),
            self::inquiry => __('application.inquiry'),
            self::complaint => __('application.complaint'),
            self::other  => __('application.other'),
        };
    }
}
