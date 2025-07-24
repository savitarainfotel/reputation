<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use App\Models\Property;

class GoogleReviewsScrape
{
    use SerializesModels;

    public $property;

    public function __construct(Property $property)
    {
        $this->property = $property;
    }
}