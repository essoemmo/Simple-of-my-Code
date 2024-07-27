<?php

namespace App\Models\Web;

use App\Traits\HasAttachmentTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    protected $table = 'settings';

    public $timestamps = true;

    use HasAttachmentTrait;
    use SoftDeletes;

    protected $fillable = ['key', 'value'];
    protected $dates = ['deleted_at'];

    protected $hidden = ['create_at', 'updated_at', 'deleted_at'];

    protected $casts = [
    ];
}
