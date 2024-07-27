<?php

namespace App\Models\Web;

use App\Enums\Options\MessageTypeEnum;
use App\Traits\Filterable;
use App\Traits\HasAttachmentTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactUs extends Model
{
    use HasAttachmentTrait;
    use SoftDeletes;
    use Filterable;

    protected $table = 'contact_us';

    protected $fillable = ['name', 'email', 'phone','message_type','message'];
    public $timestamps = true;


    protected array $dates = ['deleted_at'];

    protected $hidden = ['create_at', 'updated_at', 'deleted_at'];

    protected $casts = [
        'message_type' => MessageTypeEnum::class,
    ];

    protected array $filterableColumns = [
        'name' => 'like',
        'email' => 'like',
        'phone' => 'like',
    ];
}
