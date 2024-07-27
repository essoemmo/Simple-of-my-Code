<?php

namespace App\Models\Exams;

use App\Enums\Options\ActiveEnum;
use App\Traits\Filterable;
use App\Traits\HasAttachmentTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Certificate extends Model
{
    use HasAttachmentTrait;
    use SoftDeletes;
    use Filterable;


    protected $table = 'certificates';

    public $timestamps = true;

    protected array $dates = ['deleted_at'];

    protected $fillable = [ 'template_id', 'name_ar', 'name_en', 'status','description','qr_code','Administrator','signature'];

//    protected array $filterableColumns = [
//        'name_ar' => 'like',
//        'name_en' => 'like',
//        'status' => 'equals',
//    ];
    protected $hidden = ['create_at', 'updated_at', 'deleted_at'];

    protected $casts = [
        'status' => ActiveEnum::class
    ];

    public function exam(): BelongsTo
    {
        return $this->BelongsTo(Exam::class);
    }
}
