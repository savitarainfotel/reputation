<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Review;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class ReviewsController extends Controller
{
    /**
     * Display the reviews list.
     */
    public function index(Request $request, Property $property): View|JsonResponse|RedirectResponse
    {
        if ($request->ajax()) {
            // $data['competitors'] = $property->competitors;
            // $view = view('competitors.competitors', $data)->render();

            // return response()->json(['html' => $view, 'progress' => $data['competitors']->count() / gs('max-competitors') * 100, 'count' => $data['competitors']->count(), 'href' => route('competitors.create', $property)]);
        } else {
            $data['properties'] = Property::where('client_id', authUser()->id)->get();

            if(!$data['properties']->count()) {
                return redirect()->route("properties.create");
            }

            $data['reviews'] = Review::with('rating_platform.platform', 'property')->get();
           
            return view('reviews.list', $data);
        }
    }
}