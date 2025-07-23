<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;
use App\Events\GoogleReviewsScrape;

class HandleGoogleReviewsScrape implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     */
    public function handle(GoogleReviewsScrape $event): void
    {
        $response = Http::get("https://serpapi.com/search.json?engine=google_maps_reviews&place_id=".$event->property->place_id."&reviews=1&gl=us&hl=en&api_key=".gs('serp-api'));

        if ($response->successful()){
            $event->property->googleapis_log = $response->json();
            $event->property->save();
        }
    }
}