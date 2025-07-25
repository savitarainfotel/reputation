<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use App\Constants\Status;

class Property extends BaseModel
{
    protected $casts = [
        'googleapis_log' => 'object',
    ];

    public function platforms()
    {
        return $this->hasMany(RatingSetting::class, 'property_id');
    }

    public function getImageLink(string $class = null, int $height = null, int $width = null): string {
        if (!$this->image) {
            return '';
        }

        $url = Storage::disk('public')->url(getFilePath('property-images') . $this->image);
        return '<img src="' . $url . '" height="' . $height . '" width="' . $width . '" class="' . $class . '" />';
    }

    public function google()
    {
        return $this->platforms()->whereHas('platform', function ($query) {
            $query->where('is_default', Status::YES)->where('is_delete', Status::NO);
        })->first();
    }
}