<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Competitor;
use App\Models\CompetitorSetting;
use App\Models\Property;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use App\Events\ImageDownloadCompetitor;
use App\Events\ReviewsCountScrapeCompetitor;
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

            return response()->json(['html' => $view, 'progress' => $data['competitors']->count() / gs('max-competitors') * 100, 'count' => $data['competitors']->count(), 'href' => route('competitors.create', $property)]);
        } else {
            $data['properties'] = Property::where('client_id', authUser()->id)->get();
            return view('competitors.list', $data);
        }
    }

    /**
     * Show the form for creating or updating a new resource.
     */
    public function addOrUpdate(Request $request, Property $property): View|JsonResponse|RedirectResponse
    {
        if ($request->isMethod('get')) {
            $data['property'] = $property;
            $data['title']    = __('Find Your Business');

            if($property->competitors->count() >= gs('max-competitors')) {
                return redirect()->route("competitors.index")->with('status', __("All competitors for the property have been added!"));
            }

            return view('competitors.form', $data);
        }

        if ($request->isMethod('post')) {
            if (!$request->ajax()) {
                return abort(404);
            }

            return $this->processForm($request, $property);
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
    private function processForm(Request $request, Property $property): JsonResponse
    {
        $this->validateRequest($request);
        
        $user   = authUser();
        $userId = $user->id;

        $competitor               = new Competitor();
        $competitor->name         = $request->name;
        $competitor->property_id  = $property->id;
        $competitor->place_id     = $request->place_id;
        $competitor->latitude     = $request->latitude;
        $competitor->longitude    = $request->longitude;
        $competitor->address      = $request->address;
        $competitor->created_by   = $userId;
        $competitor->client_id    = $userId;
        $competitor->updated_by   = $userId;
        $competitor->reviews      = 0;
        $saved = $competitor->save();

        $platform = Platform::where('is_default', Status::YES)->where('is_delete', Status::NO)->first();

        if($platform) {
            $competitorSetting = new CompetitorSetting();
            $competitorSetting->name = $request->name;
            $competitorSetting->address = $request->address;
            $competitorSetting->competitor_id = $competitor->id;
            $competitorSetting->rating_platform_id = $platform->id;
            $competitorSetting->status = Status::YES;
            $competitorSetting->rating_url = !empty($request->url) ? $request->url : "https://search.google.com/local/writereview?placeid={$request->place_id}";
            $competitorSetting->save();
        }

        if($saved) {
            event(new ImageDownloadCompetitor($request->image_url, $competitor, $competitorSetting, null, ['competitor', 'competitorSetting']));
            event(new ReviewsCountScrapeCompetitor($competitor, $competitorSetting));
        }

        $message = $saved
            ? ['message' => __("Competitor added successfully"), 'redirect' => route('competitors.add.platforms', $competitor)]
            : ['message' => __("Some error occurred")];

        return response()->json($message);
    }

    /**
     * Show the form for creating or updating a new resource.
     */
    public function infos(Request $request, Competitor $competitor): View|JsonResponse
    {
        if ($request->isMethod('get')) {
            $data['competitor'] = $competitor;
            $data['title']    = __('Add More Platforms');

            return view('competitors.infos', $data);
        }

        if ($request->isMethod('post')) {
            if (!$request->ajax()) {
                return abort(404);
            }

            $request->validate([
                'name'          => ['required','string','max:250']
            ]);

            $competitor->name = $request->name;
            $saved = $competitor->save();

            $message = $saved
                ? ['message' => __("Competitor name saved successfully"), 'redirect' => route('competitors.index')]
                : ['message' => __("Some error occurred")];

            return response()->json($message);
        }
    }

    /**
     * Validate the resource.
     */
    private function validateRequest(Request $request)
    {
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