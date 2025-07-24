<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\ImageDownload;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class HandleImageDownload implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     */
    public function handle(ImageDownload $event): void
    {
        if($event->imagePath) {
            $response = Http::get($event->imagePath);

            if ($response->successful()) {
                $extension = match ($response->header('Content-Type')) {
                    'image/jpeg' => 'jpg',
                    'image/png' => 'png',
                    'image/webp' => 'webp',
                    default => 'jpg',
                };

                $event->property->image = Str::slug($event->property->name) . '.' . $extension;

                Storage::disk('public')->put(getFilePath('property-images') . $event->property->image, $response->body());

                $event->property->save();
            }
        }
    }
}