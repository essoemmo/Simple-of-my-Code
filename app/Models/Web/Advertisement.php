<?php

namespace App\Models\Web;

use App\Enums\Options\ActiveEnum;
use App\Traits\Filterable;
use App\Traits\HasAttachmentTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advertisement extends Model
{

    use HasAttachmentTrait;
    use SoftDeletes;
    use Filterable;

    protected $table = 'advertisements';
    public $timestamps = true;
    protected $guarded = [];

    protected array $dates = ['deleted_at'];

    protected $hidden = ['create_at', 'updated_at', 'deleted_at'];

    protected $casts = [
        'status' => ActiveEnum::class,
    ];

    protected array $filterableColumns = [
        'name' => 'like',
    ];
}
