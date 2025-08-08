<?php

namespace App\Traits;

use Google_Client;
use Google_Service_MyBusinessAccountManagement;
use App\Constants\Status;
use App\Models\Review;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Carbon\Carbon;

trait Replyable
{
    protected function getAccounts(Request $request, Review $review)
    {
        $ratingSetting = $review->rating_platform;

        $accessToken = $ratingSetting->access_token;
        $client = google_Client($ratingSetting);
        
        try {
            $client->setAccessToken($accessToken);

            if ($client->isAccessTokenExpired()) {
                if ($client->getRefreshToken()) {
                    try {
                        $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
                        $ratingSetting->access_token = $client->getAccessToken();
                        $ratingSetting->save();
                    } catch (Exception $e) {
                        $ratingSetting->access_token = null;
                        $ratingSetting->save();
                        return response()->json(['message' => __("Error refreshing token: Please connected again.")]);
                    }
                } else {
                    $ratingSetting->access_token = null;
                    $ratingSetting->save();
                    return response()->json(['message' => __("No refresh token available. Please connected again.")]);
                }
            }

            $service_account = new Google_Service_MyBusinessAccountManagement($client);
            $accountsResponse = $service_account->accounts->listAccounts();

            return ['accounts' => $accountsResponse->getAccounts(), 'client' => $client];
        } catch (\Throwable $th) {
            return response()->json(['message' => __("Your google account is disconnected. Please connected again.")]);
        }
    }

    protected function google(Request $request, Review $review): JsonResponse
    {
        $accounts = $this->getAccounts($request, $review);

        if(is_array($accounts)) {
            $client  = $accounts['client'];
            $account = $accounts['accounts'];

            if (!empty($account)) {
                $ratingSetting = $review->rating_platform;
                $accountName = $account[0]->getName();
                $reviewLocationName = $ratingSetting->google_location;

                try {
                    $headers = [
                        'Authorization' => 'Bearer ' . $client->getAccessToken()['access_token'],
                        'Accept'        => 'application/json',
                    ];

                    $url = "https://mybusiness.googleapis.com/v4/{$accountName}/{$reviewLocationName}/reviews/{$review->platform_review_id}";

                    $existingReview = Http::withHeaders($headers)->get($url)->json();

                    if(!$existingReview) {
                        return response()->json(['message' => __('Review not found!')]);
                    } else {
                        try {
                            $putData = [
                                'comment' => $request->reply
                            ];

                            $response = Http::withHeaders($headers)->put("{$url}/reply", $putData);

                            if ($response->successful()) {
                                $putData['updateTime']  = $review->reply->updateTime ?? Carbon::now('UTC')->format('Y-m-d\TH:i:s.u\Z');
                                $review->reply          = $putData;
                                $review->is_reply_given = Status::YES;
                                $review->is_answered    = Status::YES;
                                $review->save();

                                $request->request->remove('reply');

                                return $this->detail($request, $review, __('The reply published.'));
                            } else {
                                return response()->json(['message' => __('The reply not published!')]);
                            }
                        } catch (ConnectionException $e) {
                            return response()->json(['message' => __('The request timed out. Please try again later.')]);
                        }
                    }
                } catch (ConnectionException $e) {
                    return response()->json(['message' => __('The request timed out. Please try again later.')]);
                }
            } else {
                return response()->json(['message' => __('No Google Business Profile accounts found!')]);
            }
        } else {
            return $accounts;
        }
    }

    protected function unpublishGoogleReply(Request $request, Review $review): JsonResponse
    {
        $accounts = $this->getAccounts($request, $review);

        if(is_array($accounts)) {
            $client  = $accounts['client'];
            $account = $accounts['accounts'];

            if (!empty($account)) {
                $ratingSetting = $review->rating_platform;
                $accountName = $account[0]->getName();
                $reviewLocationName = $ratingSetting->google_location;

                try {
                    $headers = [
                        'Authorization' => 'Bearer ' . $client->getAccessToken()['access_token'],
                        'Accept'        => 'application/json',
                    ];

                    $url = "https://mybusiness.googleapis.com/v4/{$accountName}/{$reviewLocationName}/reviews/{$review->platform_review_id}";

                    $existingReview = Http::withHeaders($headers)->get($url)->json();

                    if(!$existingReview) {
                        return response()->json(['message' => __('Review not found!')]);
                    } else {
                        try {
                            $response = Http::withHeaders($headers)->delete("{$url}/reply");

                            if ($response->successful()) {
                                $review->reply          = null;
                                $review->is_reply_given = Status::NO;
                                $review->is_answered    = Status::NO;
                                $review->save();

                                $request->request->remove('reply');

                                return $this->detail($request, $review, __('The reply unpublish.'));
                            } else {
                                return response()->json(['message' => __('The reply not unpublish!')]);
                            }
                        } catch (ConnectionException $e) {
                            return response()->json(['message' => __('The request timed out. Please try again later.')]);
                        }
                    }
                } catch (ConnectionException $e) {
                    return response()->json(['message' => __('The request timed out. Please try again later.')]);
                }
            } else {
                return response()->json(['message' => __('No Google Business Profile accounts found!')]);
            }
        } else {
            return $accounts;
        }
    }
}