<?php

namespace App\Listeners;

use App\Events\ImageDownloadOfReview;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HandleImageDownloadOfReview implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     */
    public function handle(ImageDownloadOfReview $event): void
    {
        if($event->review && $event->review->reviewer_avatar) {
            $response = Http::get($event->review->reviewer_avatar);

            if ($response->successful()) {
                $extension = match ($response->header('Content-Type')) {
                    'image/jpeg' => 'jpg',
                    'image/png' => 'png',
                    'image/webp' => 'webp',
                    default => 'jpg',
                };

                $image = (string) Str::ulid()->toRfc4122() . '.' . $extension;

                Storage::disk('public')->put(getFilePath('review-images') . $image, $response->body());

                $event->review->reviewer_avatar = $image;
                $event->review->save();
            }
        }
    }
}