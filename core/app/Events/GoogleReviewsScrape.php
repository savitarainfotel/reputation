<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use App\Models\Property;
use App\Models\RatingSetting;

class GoogleReviewsScrape
{
    use SerializesModels;

    public $property;
    public $ratingSetting;

    public function __construct(Property $property, RatingSetting $ratingSetting)
    {
        $this->property = $property;
        $this->ratingSetting = $ratingSetting;
    }
}