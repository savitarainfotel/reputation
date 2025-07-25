<?php

namespace App\Listeners;

use App\Events\ImageDownload;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class HandleImageDownload 
{
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

                $event->image = $event->image . '.' . $extension;

                Storage::disk('public')->put(getFilePath('property-images') . $event->image, $response->body());

                if(in_array('property', $event->type)) {
                    $event->property->image = $event->image;
                    $event->property->save();
                }

                if(in_array('ratingSetting', $event->type)) {
                    $event->ratingSetting->picture = $event->image;
                    $event->ratingSetting->save();
                }
            }
        }
    }
}