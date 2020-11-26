<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CouponPublisher extends Model
{
    use HasDateTimeFormatter;

    public function codes(): BelongsToMany
    {
        $pivotTable = 'coupon_code_publisher'; // 中间表

        $relatedModel = CouponCode::class; // 关联模型类名

        return $this->belongsToMany($relatedModel, $pivotTable, 'code_id', 'publisher_id');
    }
}
