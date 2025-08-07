<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Review;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;
use Google_Client;
use Google_Service_MyBusinessAccountManagement;
use App\Constants\Status;

class ReviewsController extends Controller
{
    /**
     * Display the reviews list.
     */
    public function index(Request $request, Property $property): View|JsonResponse|RedirectResponse
    {
        if ($request->ajax()) {
            $data['reviews']  = $property->reviews()->paginate(10);
            $data['property'] = $property;

            $view = view('reviews.reviews', $data)->render();

            return response()->json(['html' => $view]);
        } else {
            $data['properties'] = Property::where('client_id', authUser()->id)->get();
            $data['reviews'] = Review::with('rating_platform.platform', 'property')->get();

            return view('reviews.list', $data);
        }
    }

    /**
     * Display the reviews list.
     */
    public function detail(Request $request, Review $review): View|JsonResponse
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $data['review']  = $review;
        $data['property'] = $review->property;
        $data['languages'] = json_decode(gs('languages')) ?? [];

        $view = view('reviews.detail', $data)->render();

        return response()->json(['html' => $view]);
    }

    /**
     * Generate Reply of the review.
     */
    public function generateReply(Request $request, Review $review): View|JsonResponse
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $name      = $review->reviewer;
        $summary   = !empty($review->title) ? $review->title : "$review->reviewer has given $review->normalized_rating rating to our service out of 5.";

        $headers   = [
            "Content-Type" => "application/json",
            "Authorization" => "Bearer ".gs("openai-api")
        ];

        $postData   = [
            "model" => gs("openai-model"),
            "messages" => [
                [
                    "role" => "system", "content" => "You are an assistant that writes professional and polite replies to Google reviews."
                ],
                [
                    "role" => "user",
                    "content" => 'Customer: "'.$name.'"
                        Review: "'.$summary.'"
                        Business: "'.$review->property->name.'"
                        Write a kind, professional reply to this review.
                        Signatue: "'.$review->property->signature.'"'
                ]
            ],
            "max_tokens" => (Int) gs("openai-max-tokens")
        ];

        try {
            $response = Http::withHeaders($headers)->post(gs("openai-url"), $postData)->json();

            $reply = null;

            if (isset($response['choices']) && isset($response['choices'][0]) && isset($response['choices'][0]['message']) && isset($response['choices'][0]['message']['content'])) {
                $reply = $response['choices'][0]['message']['content'];
            }

            $request->merge(['reply' => $reply]);

            return $this->detail($request, $review);
        } catch (ConnectionException $e) {
            return response()->json(['message' => __('The request timed out. Please try again later.')]);
        }
    }

    /**
     * Mark Answered or Unanswered the review.
     */
    public function markAnsweredUnanswered(Request $request, Review $review): View|JsonResponse
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $review->is_answered = !$review->is_answered;
        $review->save();

        return $this->detail($request, $review);
    }

    /**
     * Send reply or Unanswered review.
     */
    public function reply(Request $request, Review $review): View|JsonResponse
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $request->validate([
            'reply' => ['required']
        ]);

        $ratingSetting = $review->rating_platform;

        $accessToken = $ratingSetting->access_token;
        $client = google_Client($ratingSetting);
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
                    return response()->json(['message' => __("Error refreshing token: Please log in again.")]);
                }
            } else {
                $ratingSetting->access_token = null;
                $ratingSetting->save();
                return response()->json(['message' => __("No refresh token available. Please log in again.")]);
            }
        }

        $service_account = new Google_Service_MyBusinessAccountManagement($client);
        $accountsResponse = $service_account->accounts->listAccounts();
        $accounts = $accountsResponse->getAccounts();

        if (!empty($accounts)) {
            $accountName = $accounts[0]->getName();
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
                            $putData['updateTime'] = $review->reply->updateTime;
                            $review->reply         = $putData;
                            $review->is_answered   = Status::YES;
                            $review->save();

                            return $this->detail($request, $review);
                        } else {
                            return response()->json(['message' => __('Reply not sent!')]);
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
    }
}