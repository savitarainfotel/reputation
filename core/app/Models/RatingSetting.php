<?php

namespace App\Models;

class RatingSetting extends BaseModel
{
    public function platform()
    {
        return $this->belongsTo(Platform::class, 'rating_platform_id');
    }
}