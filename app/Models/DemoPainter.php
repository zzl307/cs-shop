<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DemoPainter extends Model
{
    public function paintings()
    {
        return $this->hasMany(DemoPainting::class, 'painter_id');
    }
}
