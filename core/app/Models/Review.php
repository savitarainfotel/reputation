<?php

namespace App\Models;

use App\Constants\Status;

class Review extends BaseModel
{
    protected $casts = [
        'datetime' => 'datetime',
        'reply' => 'object',
    ];

    public function rating_platform()
    {
        return $this->belongsTo(RatingSetting::class, 'rating_platform_id');
    }

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }

    public function getNormalizedRatingAttribute()
    {
        return $this->rating > 5 ? round($this->rating * 5 / 10, 1) : round($this->rating, 1);
    }

    public function getStarImagesAttribute()
    {
        return collect()->times(floor($this->normalized_rating), fn() => '<img src="' . asset('assets/images/svg/star.svg') . '" alt="star" class="me-1" />')->implode('');
    }
}