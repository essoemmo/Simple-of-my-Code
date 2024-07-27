<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Attachment extends Model
{
    protected $table = 'attachments';

    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function size(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => round($value, 2)
        );
    }

    public function scopeProfileImage($query)
    {
        return $query->where('title', 'profile')->first()?->file;
    }

    public function attachmentable(): MorphTo
    {
        return $this->morphTo();
    }
}
