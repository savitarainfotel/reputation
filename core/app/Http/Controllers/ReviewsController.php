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

class ReviewsController extends Controller
{
    /**
     * Display the reviews list.
     */
    public function index(Request $request, Property $property): View|JsonResponse|RedirectResponse
    {
        if ($request->ajax()) {
            $data['reviews']  = $property->reviewList()->paginate(10);
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
            return response()->json(['message' => 'The request timed out. Please try again later.'], 400);
        }
    }
}