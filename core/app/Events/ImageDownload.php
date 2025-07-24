<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use App\Models\Property;
use App\Models\RatingSetting;
use Illuminate\Support\Str;

class ImageDownload
{
    use SerializesModels;

    public $imagePath;
    public $property;
    public $ratingSetting;
    public $type;
    public $image;

    public function __construct(String $imagePath, Property $property, RatingSetting $ratingSetting, String $name = null, Array $type = ['property', 'ratingSetting'])
    {
        $this->imagePath = $imagePath;
        $this->property = $property;
        $this->ratingSetting = $ratingSetting;
        $this->type = $type;
        $this->image = Str::slug($name ?? $property->name);
    }
}