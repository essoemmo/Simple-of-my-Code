<?php

namespace Web;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    protected $table = 'orders';

    public $timestamps = true;

    use HasAttachmentTrait;
    use SoftDeletes;

    protected $guarded = [];

    protected $dates = ['deleted_at'];

    protected $hidden = ['create_at', 'updated_at', 'deleted_at'];

    protected $casts = [
    ];
}
