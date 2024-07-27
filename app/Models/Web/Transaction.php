<?php

namespace Web;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    protected $table = 'transactions';

    public $timestamps = true;

    use HasAttachmentTrait;
    use SoftDeletes;

    protected $guarded = [];

    protected $dates = ['deleted_at'];

    protected $hidden = ['create_at', 'updated_at', 'deleted_at'];

    protected $casts = [
    ];
}
