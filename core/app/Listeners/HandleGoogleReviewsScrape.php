<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;
use App\Events\GoogleReviewsScrape;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

class HandleGoogleReviewsScrape implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     */
    public function handle(GoogleReviewsScrape $event): void
    {
        $response = Http::get("https://wextractor.com/api/v1/reviews/google?id=".$event->property->place_id."&auth_token=".gs('wextractor-api')."&sort=relevancy");

        if ($response->successful()){
            $response = $response->json();

            if(!empty($response['reviews'])) {
                DB::beginTransaction();

                try {
                    foreach ($response['reviews'] as $review) {
                        $newReview                     = new Review();
                        $newReview->rating_platform_id = $event->ratingSetting->id;
                        $newReview->property_id        = $event->ratingSetting->property_id;
                        $newReview->title              = $review["text"] ?? null;
                        $newReview->url                = $review["url"] ?? null;
                        $newReview->reviewer           = $review["reviewer"] ?? null;
                        $newReview->reviewer_avatar    = $review["reviewer_avatar"] ?? null;
                        $newReview->reviewer_id        = $review["reviewer_id"] ?? null;
                        $newReview->reviewer_url       = $review["reviewer_url"] ?? null;
                        $newReview->datetime           = $review["datetime"] ?? null;
                        $newReview->rating             = $review["rating"] ?? null;
                        $newReview->language           = $review["language"] ?? null;
                        $newReview->likes              = $review["likes"] ?? null;
                        $newReview->reply              = $review["reply"] ?? null;
                        $newReview->created_by         = $event->property->created_by;
                        $newReview->updated_by         = $event->property->updated_by;
                        $newReview->save();
                    }

                    $event->property->reviews = count($response['reviews']);
                    $event->property->save();

                    DB::commit();
                } catch (\Throwable $th) {
                    DB::rollBack();
                }
            }
        }
    }
}