<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Property;
use App\Models\Platform;
use App\Models\RatingSetting;
use App\Constants\Status;
use App\Traits\Scrapable;
use App\Events\ImageDownload;

class PlatformsController extends Controller
{
    use Scrapable;
    /**
     * Search the platforms url.
     */
    public function search(Request $request, Property $property, Platform $platform): JsonResponse
    {
        if(!empty($request->platform[$platform->enc_id])) {
            $requestUrl = $request->platform[$platform->enc_id];
            $platformUrlHost = parse_url($platform->platform_url ?? '')['host'] ?? '';
            $requestUrlHost = parse_url($requestUrl ?? '')['host'] ?? '';

            if($platformUrlHost === $requestUrlHost) {
                switch ($platformUrlHost) {
                    case 'www.agoda.com':
                        $message = $this->scrapeAgoda($requestUrl, $property, $platform);
                        break;

                    case 'www.booking.com':
                        $message = $this->scrapeBooking($requestUrl, $property, $platform);
                        break;

                    case 'www.expedia.com':
                        $message = $this->scrapeExpedia($requestUrl, $property, $platform);
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
    public function addOrUpdate(Request $request, Property $property, RatingSetting $ratingSetting): JsonResponse
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
            return $this->processForm($request, $property, $ratingSetting);
        }
    }
    
    /**
     * Process the resource in storage.
     */
    private function processForm(Request $request, Property $property, RatingSetting $ratingSetting): JsonResponse
    {
        $this->validateRequest($request, $property);

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

            event(new ImageDownload($request->picture, $property, $ratingSetting, $request->name, ['ratingSetting']));

            $message = $saved
                ? ['message' => __("Listing added successfully"), 'redirect' => route('properties.add.platforms', $property)]
                : ['message' => __("Some error occurred")];
        } else {
            $message = ['message' => __("Platform not found!")];
        }

        return response()->json($message);
    }

    /**
     * Validate the resource.
     */
    private function validateRequest(Request $request, Property $property)
    {
        if (!$property->exists) {
            $request->validate([
                'name' => ['required','string','max:250'],
                'address' => ['required','string','max:250'],
                'picture' => ['required','string'],
                'platform_url' => ['required','string','max:250'],
                'platform_id' => ['required', 'string']
            ]);
        }
    }
}