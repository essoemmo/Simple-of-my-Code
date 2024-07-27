<?php

namespace App\Models\Settings;

use App\Enums\Options\StatusEnum;
use App\Traits\Filterable;
use App\Traits\HasAttachmentTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nationality extends Model
{
    use HasAttachmentTrait;
    use SoftDeletes;
    use Filterable;

    protected $table = 'nationalities';

    protected $fillable = ['name_en', 'name_ar', 'code', 'status'];

    protected array $filterableColumns = [
        'name_ar' => 'like',
        'name_en' => 'like',
        'status' => 'equals',
        'code' => 'like',
    ];

    protected $appends = ['name'];

    public $timestamps = true;

    protected $hidden = ['create_at', 'updated_at', 'deleted_at'];

    protected array $dates = ['deleted_at'];

    protected $casts = [
        'status' => StatusEnum::class,
    ];


    public function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->{'name_'.app()->getLocale()}
        );
    }

}
