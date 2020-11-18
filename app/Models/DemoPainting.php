<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DemoPainting extends Model
{
    protected $fillable = ['title', 'body', 'completed_at'];

    public function painter()
    {
        return $this->belongsTo(DemoPainter::class, 'painter_id');
    }
}
