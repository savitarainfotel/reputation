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
    public $shouldScrapped;

    public function __construct(Property $property, RatingSetting $ratingSetting, Bool $shouldScrapped = true)
    {
        $this->property = $property;
        $this->ratingSetting = $ratingSetting;
        $this->shouldScrapped = $shouldScrapped;
    }
}