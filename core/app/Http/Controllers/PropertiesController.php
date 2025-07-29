<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Property;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use App\Events\ImageDownload;
use App\Events\GoogleReviewsScrape;
use App\Models\Platform;
use App\Models\RatingSetting;
use App\Constants\Status;

class PropertiesController extends Controller
{
    /**
     * Display the properties list.
     */
    public function index(Request $request): View
    {
        $data['properties'] = Property::where('client_id', authUser()->id)->get();
        return view('properties.list', $data);
    }

    /**
     * Show the form for creating or updating a new resource.
     */
    public function addOrUpdate(Request $request): View|JsonResponse
    {
        if ($request->isMethod('get')) {
            $data['property'] = new Property();
            $data['title']    = __('Find Your Business');

            return view('properties.form', $data);
        }

        if ($request->isMethod('post')) {
            if (!$request->ajax()) {
                return abort(404);
            }

            $property = new Property();
            return $this->processForm($request, $property);
        }
    }

    /**
     * Show the form for creating or updating a new resource.
     */
    public function addPlatforms(Request $request, Property $property): View|JsonResponse|RedirectResponse
    {
        $data['property']  = $property;
        $data['title']     = __('Add More Platforms');
        $data['platforms'] = Platform::where('exclude', Status::NO)->where('is_default', Status::NO)->where('is_delete', Status::NO);

        if(!$data['platforms']->count()) {
            return redirect()->route('properties.infos', $property);
        }

        return view('properties.add-platforms', $data);
    }

    /**
     * Show the form for creating or updating a new resource.
     */
    public function infos(Request $request, Property $property): View|JsonResponse
    {
        if ($request->isMethod('get')) {
            $data['property'] = $property;
            $data['title']    = __('Add More Platforms');

            return view('properties.infos', $data);
        }

        if ($request->isMethod('post')) {
            if (!$request->ajax()) {
                return abort(404);
            }

            $request->validate([
                'name'          => ['required','string','max:250'],
                'business_type' => ['required','string','max:250']
            ]);

            $property->name = $request->name;
            $property->business_type = $request->business_type;
            $saved = $property->save();

            $message = $saved
                ? ['message' => __("Property Type saved successfully"), 'redirect' => route('properties.add.signature', $property)]
                : ['message' => __("Some error occurred")];

            return response()->json($message);
        }
    }

    /**
     * Show the form for creating or updating a new resource.
     */
    public function addSignature(Request $request, Property $property): View|JsonResponse
    {
        if ($request->isMethod('get')) {
            $data['property'] = $property;
            $data['title']    = __('Add Signature');

            return view('properties.signature', $data);
        }

        if ($request->isMethod('post')) {
            if (!$request->ajax()) {
                return abort(404);
            }

            $request->validate([
                'signature' => ['required','string','max:250']
            ]);

            $property->signature = $request->signature;
            $saved = $property->save();

            $message = $saved
                ? ['message' => __("Property signature saved successfully"), 'redirect' => route('properties.index')]
                : ['message' => __("Some error occurred")];

            return response()->json($message);
        }
    }

    /**
     * Process the resource in storage.
     */
    private function processForm(Request $request, Property $property): JsonResponse
    {
        $this->validateRequest($request, $property);
        $user   = authUser();
        $userId = $user->id;
        
        $property->name         = $request->name;
        $property->place_id     = $request->place_id;
        $property->latitude     = $request->latitude;
        $property->longitude    = $request->longitude;
        $property->address      = $request->address;
        $property->created_by   = $userId;
        $property->client_id    = $userId;
        $property->updated_by   = $userId;
        $property->reviews      = 0;
        $property->signature    = "Best Regards,\n{$request->name}";
        $saved = $property->save();

        $platform = Platform::where('is_default', Status::YES)->where('is_delete', Status::NO)->first();

        $ratingSetting = new RatingSetting();
        $ratingSetting->name = $request->name;
        $ratingSetting->address = $request->address;
        $ratingSetting->property_id = $property->id;
        $ratingSetting->rating_platform_id = $platform->id;
        $ratingSetting->status = Status::YES;
        $ratingSetting->min_rating = 4;
        $ratingSetting->average_review = 4;
        $ratingSetting->rating_url = !empty($request->url) ? $request->url : "https://search.google.com/local/writereview?placeid={$request->place_id}";
        $ratingSetting->save();

        event(new ImageDownload($request->image_url, $property, $ratingSetting));
        event(new GoogleReviewsScrape($property, $ratingSetting));

        $message = $saved
            ? ['message' => __("Property added successfully"), 'redirect' => route('properties.add.platforms', $property)]
            : ['message' => __("Some error occurred")];

        return response()->json($message);
    }

    /**
     * Validate the resource.
     */
    private function validateRequest(Request $request, Property $property)
    {
        if (!$property->exists) {
            $request->validate([
                'name' => [
                    'required',
                    'string',
                    'max:250',
                ],
                'place_id' => ['required', 'string']
            ]);
        }
    }
}