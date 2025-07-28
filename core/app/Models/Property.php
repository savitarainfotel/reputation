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

    public function getImage(string $class = null, int $height = null, int $width = null): string {
        if (!$this->image) {
            return '';
        }

        return '<img src="' . $this->getImageLink() . '" height="' . $height . '" width="' . $width . '" class="' . $class . '" />';
    }

    public function getImageLink(): string {
        if (!$this->image) {
            return '';
        }

        return Storage::disk('public')->url(getFilePath('property-images') . $this->image);
    }

    public function google()
    {
        return $this->platforms()->whereHas('platform', function ($query) {
            $query->where('is_default', Status::YES)->where('is_delete', Status::NO);
        })->first();
    }

    public function competitors()
    {
        return $this->hasMany(Competitor::class, 'property_id');
    }
}