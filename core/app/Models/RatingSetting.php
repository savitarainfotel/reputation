<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;

class RatingSetting extends BaseModel
{
    protected $casts = [
        'access_token' => 'array',
    ];

    public function platform()
    {
        return $this->belongsTo(Platform::class, 'rating_platform_id');
    }

    public function getImage(string $class = null, int $height = null): string {
        if (!$this->picture) {
            return '';
        }

        $url = Storage::disk('public')->url(getFilePath('property-images') . $this->picture);
        return '<img src="' . $url . '" height="' . $height . '" class="' . $class . '" />';
    }
}