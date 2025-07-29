<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Property;
use App\Models\Competitor;
use App\Models\CompetitorSetting;
use App\Models\Platform;
use App\Models\RatingSetting;
use App\Constants\Status;
use App\Traits\Scrapable;
use App\Events\ImageDownload;
use App\Events\ImageDownloadCompetitor;
use App\Events\AgodaReviewsScrape;
use App\Events\BookingReviewsScrape;
use App\Events\ExpediaReviewsScrape;

class PlatformsController extends Controller
{
    use Scrapable;
    /**
     * Search the platforms url.
     */
    public function search(Request $request, Platform $platform): JsonResponse
    {
        if(!empty($request->platform[$platform->enc_id])) {
            $requestUrl = $request->platform[$platform->enc_id];
            $platformUrlHost = parse_url($platform->platform_url ?? '')['host'] ?? '';
            $requestUrlHost = parse_url($requestUrl ?? '')['host'] ?? '';

            if($platformUrlHost === $requestUrlHost) {
                switch ($platformUrlHost) {
                    case 'www.agoda.com':
                        $message = $this->scrapeAgoda($requestUrl);
                        break;

                    case 'www.booking.com':
                        $message = $this->scrapeBooking($requestUrl);
                        break;

                    case 'www.expedia.com':
                        $message = $this->scrapeExpedia($requestUrl);
                        break;

                    default:
                        $message = ['message' => __("Invalid platform selected.")];
                        break;
                }
            } else {
                $message = ['message' => __("Invalid platform selected.")];
            }
        } else {
            $message = ['message' => __("Unsupported platform URL")];
        }

        return response()->json($message);
    }

    /**
     * Show the form for creating or updating a new resource.
     */
    public function addProperty(Request $request, Property $property, RatingSetting $ratingSetting): JsonResponse
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        if ($request->isMethod('get')) {
            $data['property']      = $property;
            $data['ratingSetting'] = $ratingSetting;
            $platforms             = Platform::where('exclude', Status::NO)->where('is_default', Status::NO)->where('is_delete', Status::NO);
            $ratingPlatforms       = $property->platforms->pluck('rating_platform_id');

            if($ratingPlatforms->count()) {
                $platforms->whereNotIn('id', $ratingPlatforms);
            }

            $data['platforms'] = $platforms->get();

            $view = view('platforms.form', $data)->render();
            $title = __($ratingSetting->exists ? __('Update listing') : __('Add listing'));

            return response()->json(['html' => $view, 'title' => $title, 'triggerMethod' => $ratingSetting->exists ? '' : 'initSelectWithLogo']);
        }

        if ($request->isMethod('post')) {
            return $this->processPropertyForm($request, $property, $ratingSetting);
        }
    }

    /**
     * Show the form for creating or updating a new resource.
     */
    public function addCompetitor(Request $request, Competitor $competitor, CompetitorSetting $competitorSetting): JsonResponse
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        if ($request->isMethod('get')) {
            $data['competitor']      = $competitor;
            $data['competitorSetting'] = $competitorSetting;
            $platforms             = Platform::where('exclude', Status::NO)->where('is_default', Status::NO)->where('is_delete', Status::NO);
            $ratingPlatforms       = $competitor->platforms->pluck('rating_platform_id');

            if($ratingPlatforms->count()) {
                $platforms->whereNotIn('id', $ratingPlatforms);
            }

            $data['platforms'] = $platforms->get();

            $view = view('platforms.form', $data)->render();
            $title = __($competitorSetting->exists ? __('Update listing') : __('Add listing'));

            return response()->json(['html' => $view, 'title' => $title, 'triggerMethod' => $competitorSetting->exists ? '' : 'initSelectWithLogo']);
        }

        if ($request->isMethod('post')) {
            return $this->processCompetitorForm($request, $competitor, $competitorSetting);
        }
    }

    /**
     * Process the resource in storage.
     */
    private function processPropertyForm(Request $request, Property $property, RatingSetting $ratingSetting): JsonResponse
    {
        $this->validateRequest($request);

        $platform = Platform::find($this->getDecodedId($request->platform_id));

        if($platform) {
            if(!$ratingSetting->exists) {
                $ratingSetting = new RatingSetting();
            }

            $ratingSetting->name = $request->name;
            $ratingSetting->address = $request->address;
            $ratingSetting->property_id = $property->id;
            $ratingSetting->rating_platform_id = $platform->id;
            $ratingSetting->status = Status::YES;
            $ratingSetting->min_rating = 4;
            $ratingSetting->average_review = 4;
            $ratingSetting->rating_url = $request->platform_url;
            $saved = $ratingSetting->save();

            if($saved) {
                $requestUrl = $request->platform_url;
                $platformUrlHost = parse_url($platform->platform_url ?? '')['host'] ?? '';
                $requestUrlHost = parse_url($requestUrl ?? '')['host'] ?? '';
    
                if($platformUrlHost === $requestUrlHost) {
                    switch ($platformUrlHost) {
                        case 'www.agoda.com':
                            event(new AgodaReviewsScrape($property, $ratingSetting));
                            break;

                        case 'www.booking.com':
                            event(new BookingReviewsScrape($property, $ratingSetting));
                            break;

                        case 'www.expedia.com':
                            event(new ExpediaReviewsScrape($property, $ratingSetting));
                            break;
                    }
                }

                event(new ImageDownload($request->picture, $property, $ratingSetting, $request->name.'-'.$platform->platform, ['ratingSetting']));
            }

            $message = $saved
                ? ['message' => __("Listing added successfully"), 'redirect' => route('properties.add.platforms', $property)]
                : ['message' => __("Some error occurred")];
        } else {
            $message = ['message' => __("Platform not found!")];
        }

        return response()->json($message);
    }

    /**
     * Process the resource in storage.
     */
    private function processCompetitorForm(Request $request, Competitor $competitor, CompetitorSetting $competitorSetting): JsonResponse
    {
        $this->validateRequest($request);

        $platform = Platform::find($this->getDecodedId($request->platform_id));

        if($platform) {
            if(!$competitorSetting->exists) {
                $competitorSetting = new CompetitorSetting();
            }

            $competitorSetting->name = $request->name;
            $competitorSetting->address = $request->address;
            $competitorSetting->competitor_id = $competitor->id;
            $competitorSetting->rating_platform_id = $platform->id;
            $competitorSetting->status = Status::YES;
            $competitorSetting->rating_url = $request->platform_url;
            $saved = $competitorSetting->save();

            event(new ImageDownloadCompetitor($request->picture, $competitor, $competitorSetting, $request->name.'-'.$platform->platform, ['competitor', 'competitorSetting']));

            $message = $saved
                ? ['message' => __("Listing added successfully"), 'redirect' => route('competitors.add.platforms', $competitor)]
                : ['message' => __("Some error occurred")];
        } else {
            $message = ['message' => __("Platform not found!")];
        }

        return response()->json($message);
    }

    /**
     * Validate the resource.
     */
    private function validateRequest(Request $request)
    {
        $request->validate([
            'name' => ['required','string','max:250'],
            'address' => ['required','string','max:250'],
            'picture' => ['required','string'],
            'platform_url' => ['required','string','max:250'],
            'platform_id' => ['required', 'string']
        ]);
    }
}