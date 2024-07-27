<?php

namespace Web;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    protected $table = 'order_details';

    public $timestamps = true;

    use HasAttachmentTrait;
    use SoftDeletes;

    protected $guarded = [];

    protected $dates = ['deleted_at'];

    protected $hidden = ['create_at', 'updated_at', 'deleted_at'];

    protected $casts = [
    ];
}
