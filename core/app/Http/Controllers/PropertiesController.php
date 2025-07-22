<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Property;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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
    public function infos(Request $request): View|JsonResponse
    {
        if ($request->isMethod('get')) {
            $data['property'] = new Property();
            $data['title']    = __('Add More Platforms');

            return view('properties.infos', $data);
        }

        /* if ($request->isMethod('post')) {
            if (!$request->ajax()) {
                return abort(404);
            }

            $property = new Property();
            return $this->processInfoForm($request, $property);
        } */
    }

    /**
     * Process the resource in storage.
     */
    private function processForm(Request $request, Property $property): JsonResponse
    {
        $this->validateRequest($request, $property);
        $user   = authUser();
        $userId = $user->id;

        if (!$property->exists) {
            $property->name         = $request->name;
            $property->place_id     = $request->place_id;
            $property->latitude     = $request->latitude;
            $property->longitude    = $request->longitude;
            $property->created_by   = $userId;
            $property->client_id    = $userId;
            $property->reviews      = 0;
        }

        $property->updated_by   = $userId;

        $saved = $property->save();

        $message = $saved
            ? ['message' => __("Property " . ($property->wasRecentlyCreated ? 'added' : 'updated') . " successfully"), 'redirect' => route('properties.infos', $property->id)]
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