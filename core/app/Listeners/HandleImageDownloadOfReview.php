<?php

namespace App\Listeners;

use App\Events\ImageDownloadOfReview;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Review;

class HandleImageDownloadOfReview implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     */
    public function handle(ImageDownloadOfReview $event): void
    {
        if($event->reviewIds) {
            $reviews = Review::whereIn('id', $event->reviewIds);

            if($reviews->count()) {
                foreach ($reviews->get() as $review) {
                    $response = Http::get($review->reviewer_avatar);

                    if ($response->successful()) {
                        $extension = match ($response->header('Content-Type')) {
                            'image/jpeg' => 'jpg',
                            'image/png' => 'png',
                            'image/webp' => 'webp',
                            default => 'jpg',
                        };

                        $image = (string) Str::ulid()->toRfc4122() . '.' . $extension;

                        Storage::disk('public')->put(getFilePath('review-images') . $image, $response->body());

                        $review->reviewer_avatar = $image;
                        $review->save();
                    }
                }
            }
        }
    }
}