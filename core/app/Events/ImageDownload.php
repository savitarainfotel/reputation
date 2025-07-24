<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use App\Models\Property;

class ImageDownload
{
    use SerializesModels;

    public $imagePath;
    public $property;

    public function __construct(String $imagePath, Property $property)
    {
        $this->imagePath = $imagePath;
        $this->property = $property;
    }
}