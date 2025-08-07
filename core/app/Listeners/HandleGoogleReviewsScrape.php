<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;
use App\Events\GoogleReviewsScrape;
use App\Models\Review;
use Illuminate\Support\Facades\DB;
use App\Events\ImageDownloadOfReview;
use Google_Client;
use Google_Service_MyBusinessAccountManagement;
use Google_Service_MyBusinessBusinessInformation;
use GuzzleHttp\Client as GuzzleClient;
use Carbon\Carbon;
use App\Constants\Status;

class HandleGoogleReviewsScrape implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     */
    public function handle(GoogleReviewsScrape $event): void
    {
        if($event->shouldScrapped == true) {
            $response = Http::get("https://wextractor.com/api/v1/reviews/google?id=".$event->property->place_id."&auth_token=".gs('wextractor-api')."&sort=relevancy");

            if ($response->successful()){
                $response = $response->json();

                if(!empty($response['reviews'])) {
                    DB::beginTransaction();

                    try {
                        $reviewIds = [];

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
                            $newReview->is_answered        = !empty($review["reply"]);
                            $newReview->created_by         = $event->property->created_by;
                            $newReview->updated_by         = $event->property->updated_by;
                            $newReview->save();

                            if (!empty($review["reviewer_avatar"])) {
                                $reviewIds[] = $newReview->id;
                            }
                        }

                        DB::commit();

                        if($reviewIds) {
                            event(new ImageDownloadOfReview($reviewIds));
                        }
                    } catch (\Throwable $th) {
                        DB::rollBack();
                    }
                }
            }
        } else {
            $accessToken = $event->ratingSetting->access_token;
            $client = google_Client($event->ratingSetting);
            $client->setAccessToken($accessToken);
            $reviews = [];

            if ($client->isAccessTokenExpired()) {
                if ($client->getRefreshToken()) {
                    try {
                        $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());

                        $event->ratingSetting->access_token = $client->getAccessToken();
                        $event->ratingSetting->save();

                        $this->getReviews($client, $event->ratingSetting, $event->property);
                    } catch (Exception $e) {
                        // exit("Error refreshing token: " . $e->getMessage());
                    }
                } else {
                    // exit("No refresh token available. Please log in again.");
                }
            } else {
                $this->getReviews($client, $event->ratingSetting, $event->property);
            }
        }
    }

    private function getReviews($client, $ratingSetting, $property) {
        $httpClient = new GuzzleClient([
            'headers' => [
                'Authorization' => 'Bearer ' . $ratingSetting->access_token['access_token'],
                'Accept' => 'application/json'
            ]
        ]);

        $service_account = new Google_Service_MyBusinessAccountManagement($client);
        $accountsResponse = $service_account->accounts->listAccounts();
        $accounts = $accountsResponse->getAccounts();
        
        if (!empty($accounts)) {
            $accountName = $accounts[0]->getName();
            $reviewLocationName = $ratingSetting->google_location;

            $pageToken = null;

            do {
                $url = "https://mybusiness.googleapis.com/v4/{$accountName}/{$reviewLocationName}/reviews";

                if ($pageToken) {
                    $url .= "?pageToken=" . $pageToken;
                }

                $response = $httpClient->get($url);
                $reviews = json_decode($response->getBody(), true);
    
                if (!empty($reviews)) {
                    DB::beginTransaction();
    
                    try {
                        $reviewIds = [];
                        $ratingsMap = [
                            'ONE'   => 1,
                            'TWO'   => 2,
                            'THREE' => 3,
                            'FOUR'  => 4,
                            'FIVE'  => 5
                        ];
    
                        foreach ($reviews['reviews'] as $review) {
                            $reviewId = $review["reviewId"] ?? null;
    
                            $newReview                     = $reviewId ? Review::where('platform_review_id', $reviewId)->first() : null;
                            $newReview                     = $newReview ?? new Review();
                            $newReview->platform_review_id = $reviewId;
                            $newReview->rating_platform_id = $ratingSetting->id;
                            $newReview->property_id        = $ratingSetting->property_id;
                            $newReview->title              = $review["comment"] ?? null;
                            $newReview->url                = $review["url"] ?? null;                            // pending
                            $newReview->reviewer           = !empty($review["reviewer"]) ? ($review["reviewer"]['displayName'] ?? null) : null;
                            $newReview->reviewer_avatar    = !empty($review["reviewer"]) ? ($review["reviewer"]['profilePhotoUrl'] ?? null) : null;
                            $newReview->reviewer_id        = $review["reviewer_id"] ?? null;                    // pending
                            $newReview->reviewer_url       = $review["reviewer_url"] ?? null;                   // pending
                            $newReview->datetime           = $review["createTime"] ?? null;
                            $newReview->rating             = $ratingsMap[$review['starRating']] ?? 0;
                            $newReview->language           = $review["language"] ?? 'en';
                            $newReview->likes              = $review["likes"] ?? null;
                            $newReview->reply              = $review["reviewReply"] ?? null;
                            $newReview->is_answered        = !empty($review["reviewReply"]);
                            $newReview->is_reply_given     = !empty($review["reviewReply"]);
                            $newReview->created_by         = $property->created_by;
                            $newReview->updated_by         = $property->updated_by;
                            $newReview->created_at         = Carbon::parse($review["createTime"]) ?? now();
                            $newReview->updated_at         = Carbon::parse($review["updateTime"]) ?? now();
                            $newReview->save();
    
                            if (!empty($review['reviewer']) && !empty($review['reviewer']['profilePhotoUrl'])) {
                                $reviewIds[] = $newReview->id;
                            }
                        }
    
                        $ratingSetting->reviews()->whereNull('platform_review_id')->update(['is_delete' => Status::YES]);
    
                        DB::commit();
    
                        if($reviewIds) {
                            event(new ImageDownloadOfReview($reviewIds));
                        }
                    } catch (\Throwable $th) {
                        DB::rollBack();
                    }
                }

                $pageToken = $reviews['nextPageToken'] ?? null;

            } while ($pageToken);
        }
    }
}