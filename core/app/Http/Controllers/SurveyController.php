<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use App\Models\Property;

class SurveyController extends Controller
{
    /**
     * Display the Survey list.
     */
    public function index(Request $request, Property $property): View|JsonResponse|RedirectResponse
    {
        if ($request->ajax()) {
            $data['surveys'] = $property->surveys;
            $view = view('survey.surveys', $data)->render();

            return response()->json(['html' => $view, 'href' => route('survey.create', $property)]);
        } else {
            $data['properties'] = Property::where('client_id', authUser()->id)->get();
            return view('survey.list', $data);
        }
    }

    public function addOrUpdate(Request $request, Property $property): View
    {
        return view('survey.add-survey');
    }

    public function report(Request $request): View
    {
        return view('survey.report');
    }
}