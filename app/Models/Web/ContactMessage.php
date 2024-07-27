<?php

namespace Web;

use App\Traits\HasAttachmentTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactMessage extends Model
{
    protected $table = 'contact_messages';

    public $timestamps = true;

    use HasAttachmentTrait;
    use SoftDeletes;

    protected $guarded = [];

    protected array $dates = ['deleted_at'];

    protected $hidden = ['create_at', 'updated_at', 'deleted_at'];

    protected $casts = [
    ];
}
