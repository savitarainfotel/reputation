<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use App\Constants\Status;

class Competitor extends BaseModel
{
    public function getImage(string $class = null, int $height = null, int $width = null): string {
        if (!$this->image) {
            return '';
        }

        $url = Storage::disk('public')->url(getFilePath('property-images') . $this->image);
        return '<img src="' . $url . '" height="' . $height . '" width="' . $width . '" class="' . $class . '" />';
    }

    public function platforms()
    {
        return $this->hasMany(CompetitorSetting::class, 'competitor_id');
    }

    public function reviews()
    {
        return number_format($this->platforms->pluck('reviews')->sum());
    }
}