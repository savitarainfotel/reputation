<?php

namespace App\Listeners;

use App\Events\ImageDownloadCompetitor;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class HandleImageDownloadCompetitor 
{
    /**
     * Handle the event.
     */
    public function handle(ImageDownloadCompetitor $event): void
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

                if(in_array('competitor', $event->type)) {
                    $event->competitor->image = $event->image;
                    $event->competitor->save();
                }

                if(in_array('competitorSetting', $event->type)) {
                    $event->competitorSetting->picture = $event->image;
                    $event->competitorSetting->save();
                }
            }
        }
    }
}