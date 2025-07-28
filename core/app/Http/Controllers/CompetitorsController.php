<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Competitor;
use App\Models\Property;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use App\Events\ImageDownload;
use App\Models\Platform;
use App\Constants\Status;

class CompetitorsController extends Controller
{
    /**
     * Display the competitors list.
     */
    public function index(Request $request, Property $property): View|JsonResponse
    {
        if ($request->ajax()) {
            $data['competitors'] = $property->competitors;
            $view = view('competitors.competitors', $data)->render();

            return response()->json(['html' => $view, 'progress' => $data['competitors']->count() / 5 * 100, 'count' => $data['competitors']->count()]);
        } else {
            $data['properties'] = Property::where('client_id', authUser()->id)->get();
            return view('competitors.list', $data);
        }
    }

    /**
     * Show the form for creating or updating a new resource.
     */
    public function addOrUpdate(Request $request): View|JsonResponse
    {
        if ($request->isMethod('get')) {
            $data['competitor'] = new Competitor();
            $data['title']    = __('Find Your Business');

            return view('competitors.form', $data);
        }

        if ($request->isMethod('post')) {
            if (!$request->ajax()) {
                return abort(404);
            }

            $competitor = new Competitor();
            return $this->processForm($request, $competitor);
        }
    }

    /**
     * Show the form for creating or updating a new resource.
     */
    public function addPlatforms(Request $request, Competitor $competitor): View|JsonResponse|RedirectResponse
    {
        $data['competitor']  = $competitor;
        $data['title']     = __('Add More Platforms');
        $data['platforms'] = Platform::where('exclude', Status::NO)->where('is_default', Status::NO)->where('is_delete', Status::NO);

        if(!$data['platforms']->count()) {
            return redirect()->route('competitors.infos', $competitor);
        }

        return view('competitors.add-platforms', $data);
    }

    /**
     * Process the resource in storage.
     */
    private function processForm(Request $request, Competitor $competitor): JsonResponse
    {
        $this->validateRequest($request, $competitor);
        $user   = authUser();
        $userId = $user->id;
        
        $competitor->name         = $request->name;
        $competitor->place_id     = $request->place_id;
        $competitor->latitude     = $request->latitude;
        $competitor->longitude    = $request->longitude;
        $competitor->address      = $request->address;
        $competitor->created_by   = $userId;
        $competitor->client_id    = $userId;
        $competitor->updated_by   = $userId;
        $competitor->reviews      = 0;
        $competitor->signature    = "Best Regards,\n{$request->name}";
        $saved = $competitor->save();

        $platform = Platform::where('is_default', Status::YES)->where('is_delete', Status::NO)->first();

        $ratingSetting = new RatingSetting();
        $ratingSetting->name = $request->name;
        $ratingSetting->address = $request->address;
        $ratingSetting->competitor_id = $competitor->id;
        $ratingSetting->rating_platform_id = $platform->id;
        $ratingSetting->status = Status::YES;
        $ratingSetting->min_rating = 4;
        $ratingSetting->average_review = 4;
        $ratingSetting->rating_url = !empty($request->url) ? $request->url : "https://search.google.com/local/writereview?placeid={$request->place_id}";
        $ratingSetting->save();

        event(new ImageDownload($request->image_url, $competitor, $ratingSetting));
        event(new GoogleReviewsScrape($competitor));

        $message = $saved
            ? ['message' => __("Competitor added successfully"), 'redirect' => route('competitors.add.platforms', $competitor)]
            : ['message' => __("Some error occurred")];

        return response()->json($message);
    }

    /**
     * Validate the resource.
     */
    private function validateRequest(Request $request, Competitor $competitor)
    {
        if (!$competitor->exists) {
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