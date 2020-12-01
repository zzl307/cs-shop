<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Dcat\Admin\Traits\HasDateTimeFormatter;

class CouponBusiness extends Model
{
    use HasDateTimeFormatter;

    protected $fillable = [
        'name',
        'coupon_business_id',
    ];

    public function codes()
    {
        return $this->hasMany(CouponCode::class, 'business_id');
    }
}
