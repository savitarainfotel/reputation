<?php

namespace App\Events;

use App\Models\Review;

class ImageDownloadOfReview
{
    public $review;

    public function __construct(Review $review)
    {
        $this->review = $review;
    }
}