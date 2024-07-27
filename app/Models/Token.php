<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Token extends Model
{
    protected $table = 'tokens';

    public $timestamps = true;

    protected $guarded = [];

    protected $hidden = ['updated_at', 'deleted_at'];

    public function tokenable(): MorphTo
    {
        return $this->morphTo();
    }
}
