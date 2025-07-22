<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Property;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

class PropertiesController extends Controller
{
    /**
     * Display the properties list.
     */
    public function index(Request $request): View
    {
        return view('properties.list');
    }

    /**
     * Show the form for creating or updating a new resource.
     */
    public function addOrUpdate(Request $request): JsonResponse
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        if ($request->isMethod('get')) {
            $property = new Property();
            return $this->returnForm($request, $property);
        }

        if ($request->isMethod('post')) {
            $property = new Property();
            return $this->processForm($request, $property);
        }
    }

    /**
     * Process the resource in storage.
     */
    private function returnForm(Request $request, Property $property): JsonResponse
    {
        $data['property'] = $property;

        $view = view('properties.form', $data)->render();
        $title = __($property->exists ? __('Update property') : __('Create property'));

        return response()->json(['html' => $view, 'title' => $title, 'classXl' => true, 'triggerMethod' => $property->exists ? '' : 'initAutocomplete']);
    }

    /**
     * Process the resource in storage.
     */
    private function processForm(Request $request, Property $property): JsonResponse
    {
        $this->validateRequest($request, $property);

        dd($property);
        $user   = authUser();
        $userId = $user->id;

        if (!$property->exists) {
            $property->name         = $request->name;
            $property->place_id     = $request->place_id;
            $property->latitude     = $request->latitude;
            $property->longitude    = $request->longitude;
            $property->address      = $request->address;
            $property->star_rating  = $request->star_rating;
            $property->city_id      = $city->id;
            $property->created_by   = $userId;
        }

        $property->user_id      = $request->user_id;
        $property->updated_by   = $userId;

        if($request->image_url) {
            $response = Http::get($request->image_url);

            if ($response->successful()) {
                $extension = match ($response->header('Content-Type')) {
                    'image/jpeg' => 'jpg',
                    'image/png' => 'png',
                    'image/webp' => 'webp',
                    default => 'jpg',
                };
    
                $property->property_image = Str::slug($property->name) . '.' . $extension;

                Storage::disk('public')->put(getFilePath('property-images') . $property->property_image, $response->body());
            }
        }

        $saved = $property->save();

        if($saved && $property->wasRecentlyCreated) {
            $requestArray = [
                "api-token"     => $user->createToken('api-token')->plainTextToken,
                "property_id"   => $property->id,
                "property_name" => $property->name,
                "city_name"     => $city->name,
                "latitude"      => $property->latitude,
                "longitude"     => $property->longitude,
            ];

            try {
                $response = Http::post("https://api.xplorerate.com/api/property/new", $requestArray)->json();
            } catch (ConnectionException $e) {
                $response = ['error' => 'The request timed out. Please try again later.'];
            }

            $property->scrap_request  = $requestArray;
            $property->scrap_response = $response;
            $property->save();
        }

        $message = $saved
            ? ['message' => __("Property " . ($property->wasRecentlyCreated ? 'added' : 'updated') . " successfully"), 'reloadTable' => 'properties-table', 'closeModal' => 'general-modal']
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
                    Rule::unique('properties')->ignore($property?->id ?? null),
                ],
                'address' => ['required', 'string'],
                'latitude' => ['required', 'numeric', 'between:-90,90'],
                'longitude' => ['required', 'numeric', 'between:-180,180'],
                'place_id' => ['required', 'string'],
                'image_url' => ['nullable', 'url'],
                'city' => ['required', 'string', 'max:100'],
                'state' => ['required', 'string', 'max:100'],
                'country' => ['required', 'string', 'max:100'],
                'user_id' => ['nullable', 'exists:users,id']
            ]);
        } else {
            $request->validate([
                'user_id' => ['nullable', 'exists:users,id']
            ]);
        }
    }
}