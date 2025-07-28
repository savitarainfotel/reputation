<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;

class CompetitorSetting extends BaseModel
{
    public function platform()
    {
        return $this->belongsTo(Platform::class, 'rating_platform_id');
    }
}