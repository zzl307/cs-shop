<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CouponPublishers extends Model
{
    // protected $fillable = ['business_id', 'business_name', 'market_id', 'market_name'];

    public function codes()
    {
        return $this->belongsToMany(CouponCode::class, 'code_id');
    }
}
