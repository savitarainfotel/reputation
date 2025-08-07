<?php

namespace App\Models;

use App\Constants\Status;
use Illuminate\Support\Facades\Storage;

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
        return collect()->times(floor($this->normalized_rating), fn() => '<img src="' . asset('assets/images/svg/star.svg'.Status::ASSET_VERSION) . '" alt="star" class="me-1" />')->implode('');
    }

    /**
     * Accessor for `$model->dec_id` (not often used, but here if needed)
     *
     * @return string
     */
    public function getReviewerPictureAttribute(): string|null
    {
        if (!$this->reviewer_avatar) {
            return null;
        }

        $path = getFilePath('review-images') . $this->reviewer_avatar;

        if (Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->url($path);
        }

        return null;
    }

    public function getAnsweredTextAttribute()
    {
        return $this->is_answered == Status::YES ? __('Mark as unnswered') : __('Mark as answered');
    }

    public function getLineCountAttribute()
    {
        $normalized = str_replace(["\r\n", "\r"], "\n", ($this->reply->comment ?? null));
        $lines = explode("\n", $normalized);
        return count($lines) + 1;
    }
}