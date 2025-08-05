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
}