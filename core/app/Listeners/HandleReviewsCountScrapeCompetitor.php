<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;
use App\Events\ReviewsCountScrapeCompetitor;

class HandleReviewsCountScrapeCompetitor implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     */
    public function handle(ReviewsCountScrapeCompetitor $event): void
    {
        $requestUrlHost = parse_url($event->competitorSetting->rating_url ?? '')['host'] ?? '';

        switch ($requestUrlHost) {
            case 'www.agoda.com':
                $this->updateCounts($event, "https://wextractor.com/api/v1/reviews/agoda?id=".$event->competitorSetting->rating_url."&auth_token=".gs('wextractor-api'));
                break;

            case 'www.booking.com':
                $path = parse_url($event->competitorSetting->rating_url, PHP_URL_PATH);
                $path = ltrim($path, '/');
                $path = preg_replace('/\.html$/', '', $path);
                $url = substr($path, strpos($path, '/') + 1);

                $this->updateCounts($event, "https://wextractor.com/api/v1/reviews/booking?id=".$url."&auth_token=".gs('wextractor-api'));
                break;

            case 'www.expedia.com':
                if (preg_match('/\.h(\d+)\./', $event->competitorSetting->rating_url, $matches)) {
                    $this->updateCounts($event, "https://wextractor.com/api/v1/reviews/expedia?id=".$matches[1]."&auth_token=".gs('wextractor-api'));
                }
                break;

            default:
                $this->updateCounts($event, "https://wextractor.com/api/v1/reviews/google?id=".$event->competitor->place_id."&auth_token=".gs('wextractor-api')."&sort=relevancy");
                break;
        }
    }

    protected function updateCounts($event, $url) {
        $response = Http::get($url);

        if ($response->successful()){
            $response = $response->json();

            if(!empty($response['totals']) && !empty($response['totals']['review_count'])) {
                $event->competitorSetting->reviews        = $response['totals']['review_count'] ?? 0;
                $event->competitorSetting->average_rating = $response['totals']['average_rating'] ?? '';
                $event->competitorSetting->save();
            }
        }
    }
}