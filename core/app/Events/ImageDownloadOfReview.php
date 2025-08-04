<?php

namespace App\Events;

class ImageDownloadOfReview
{
    public $reviewIds;

    public function __construct(Array $reviewIds)
    {
        $this->reviewIds = $reviewIds;
    }
}