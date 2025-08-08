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
use App\Traits\Replyable;
use App\Traits\Hashidable;
use App\Constants\Status;
use Carbon\Carbon;

class ReviewsController extends Controller
{
    use Replyable, Hashidable;

    /**
     * Display the reviews list.
     */
    public function index(Request $request, Property $property): View|JsonResponse|RedirectResponse
    {
        if ($request->ajax()) {
            $reviews = $property->reviews();
            
            $responseRate = calculateResponseRate($reviews);

            if($request->minRating) {
                $reviews->where('rating', '>=', $request->minRating);
            }

            if($request->maxRating) {
                $reviews->where('rating', '<=', $request->maxRating);
            }

            if($request->last_three_months) {
                $startDate = now()->subMonths(3)->startOfDay();
                $endDate = now()->endOfDay();

                $reviews->whereBetween('datetime', [$startDate, $endDate]);
            } else if($request->review_published) {
                $reviewPublished = explode(' - ', $request->review_published);
                $startDate = Carbon::parse(reset($reviewPublished));
                $endDate = Carbon::parse(end($reviewPublished));

                $reviews->whereBetween('datetime', [$startDate, $endDate]);
            }

            if($request->review_sources && $reviewPlatformId = $this->getDecodedId($request->review_sources)) {
                $reviews->where('rating_platform_id', $reviewPlatformId);
            }

            if($request->is_answered) {
                $reviews->where('is_answered', Status::NO);
            }

            if($request->is_reply_given) {
                $reviews->where('is_reply_given', Status::NO);
            }

            if($request->review_type == Status::REVIEWS_WITH_TXT) {
                $reviews->where('title', '<>', '')->whereNotNull('title');
            }

            if($request->review_type == Status::REVIEWS_WITHOUT_TXT) {
                $reviews->where('title', '')->orWhereNull('title');
            }

            if($request->search_text) {
                $reviews->where('title', 'like', '%' . $request->search_text . '%');
            }

            $data['reviews']  = $reviews->paginate(1);
            $data['property'] = $property;

            $view = view('reviews.reviews', $data)->render();

            return response()->json(['html' => $view, 'responseRate' => $responseRate]);
        } else {
            $data['properties'] = Property::where('client_id', authUser()->id)->get();
            $data['reviews'] = Review::with('rating_platform.platform', 'property')->get();

            return view('reviews.list', $data);
        }
    }

    /**
     * Display the reviews list.
     */
    public function detail(Request $request, Review $review, String $message = null): View|JsonResponse
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $data['review']  = $review;
        $data['property'] = $review->property;
        $data['languages'] = json_decode(gs('languages')) ?? [];
        $responseRate = calculateResponseRate($review->property->reviews());

        $view = view('reviews.detail', $data)->render();

        return response()->json(['html' => $view, 'message' => $message, 'responseRate' => $responseRate]);
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

            $request->merge(['reply' => $reply, 'type' => true]);

            return $this->detail($request, $review, __('The reply generated.'));
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

        return $this->detail($request, $review, __('The reply status changed.'));
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

        if($review->property->google()) {
            return $this->google($request, $review);
        } else {
            return response()->json(['message' => __("Invalid Listings Integration.")]);
        }
    }

    /**
     * Send reply or Unanswered review.
     */
    public function unpublishReply(Request $request, Review $review): View|JsonResponse
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        if($review->property->google()) {
            return $this->unpublishGoogleReply($request, $review);
        } else {
            return response()->json(['message' => __("Invalid Listings Integration.")]);
        }
    }
}