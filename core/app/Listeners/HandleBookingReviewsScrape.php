<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;
use App\Events\BookingReviewsScrape;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

class HandleBookingReviewsScrape implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     */
    public function handle(BookingReviewsScrape $event): void
    {
        $path = parse_url($event->ratingSetting->rating_url, PHP_URL_PATH);
        $path = ltrim($path, '/');
        $path = preg_replace('/\.html$/', '', $path);
        $url = substr($path, strpos($path, '/') + 1);

        $response = Http::get("https://wextractor.com/api/v1/reviews/booking?id=".$url."&auth_token=".gs('wextractor-api'));

        if ($response->successful()){
            $response = $response->json();

            if(!empty($response['reviews'])) {
                DB::beginTransaction();

                try {
                    foreach ($response['reviews'] as $review) {
                        $newReview                     = new Review();
                        $newReview->rating_platform_id = $event->ratingSetting->id;
                        $newReview->title              = $review["title"] ?? null;
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
                        $newReview->pros               = $review["pros"] ?? null;
                        $newReview->cons               = $review["cons"] ?? null;
                        $newReview->created_by         = $event->ratingSetting->created_by;
                        $newReview->updated_by         = $event->ratingSetting->updated_by;
                        $newReview->save();
                    }

                    $event->property->reviews += count($response['reviews']);
                    $event->property->save();

                    DB::commit();
                } catch (\Throwable $th) {
                    DB::rollBack();
                }
            }
        }
    }
}