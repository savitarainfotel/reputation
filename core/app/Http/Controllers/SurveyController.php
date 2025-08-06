<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use App\Models\Property;
use App\Models\Survey;
use App\Traits\Hashidable;
use Illuminate\Support\Facades\DB;
use App\Constants\Status;

class SurveyController extends Controller
{
    use Hashidable;
    /**
     * Display the Survey list.
     */
    public function index(Request $request, Property $property): View|JsonResponse|RedirectResponse
    {
        if ($request->ajax()) {
            $data['property'] = $property;
            $view = view('survey.surveys', $data)->render();

            return response()->json(['html' => $view]);
        } else {
            $data['properties'] = Property::where('client_id', authUser()->id)->get();
            return view('survey.list', $data);
        }
    }

    public function addOrUpdate(Request $request, Survey $survey): View|JsonResponse|RedirectResponse
    {
        if ($request->isMethod('get')) {
            $data['properties'] = Property::where('client_id', authUser()->id)->get();
            $data['survey']     = $survey;

            return view('survey.form', $data);
        }

        if ($request->isMethod('post')) {
            if (!$request->ajax()) {
                return abort(404);
            }

            return $this->processForm($request, $survey);
        }
    }

    public function edit(Request $request, Survey $survey): View|JsonResponse|RedirectResponse
    {
        if ($request->isMethod('get')) {
            $data['properties'] = Property::where('client_id', authUser()->id)->get();
            $data['survey']     = $survey;
            // dd($survey);

            return view('survey.filled-form', $data);
        }

        if ($request->isMethod('post')) {
            if (!$request->ajax()) {
                return abort(404);
            }

            return $this->processForm($request, $survey);
        }
    }

    /**
     * Process the resource in storage.
     */
    private function processForm(Request $request, Survey $survey): JsonResponse
    {
        $this->validateRequest($request, $survey);

        try {
            DB::transaction(function () use ($request, $survey) {
                $user   = authUser();
                $userId = $user->id;

                $survey->title              = $request->title;
                $survey->description        = $request->description;
                $survey->picture            = $request->picture;
                $survey->selected_color     = $request->selected_color;
                $survey->rating_scale       = $request->rating_scale;
                $survey->comment_text       = $request->comment;
                $survey->min_rating         = $request->min_rating;
                $survey->average_review     = $request->average_review;
                $survey->property_id        = $request->property_id;
                $survey->review_platform_id = $request->review_platform_id;
                $survey->client_id          = $userId;
                $survey->updated_by         = $userId;

                if (!$survey->exists) {
                    $survey->created_by     = $userId;
                }

                $survey->save();

                foreach ($request->questions as $question) {
                    $survey->questions()->create([
                        'question'   => $question,
                        'created_by'   => $userId,
                        'updated_by'   => $userId
                    ]);
                }
            });

            return response()->json(['message' => __("Survey saved successfully"), 'redirect' => route('survey.index')]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Some error occurred.'], 500);
        }
    }

    /**
     * Validate the resource.
     */
    private function validateRequest(Request $request, Survey $survey)
    {
        $request->merge([
            'review_platform_id' => $this->getDecodedId($request->review_platform_id),
            'property_id' => $this->getDecodedId($request->property_id),
        ]);

        $request->validate([
            'title' => ['required','string','max:250'],
            'description' => ['required','string','max:1000'],
            'selected_color' => ['required','string','max:10'],
            'rating_scale' => ['required','in:'.Status::NPS.','.Status::STAR],
            'questions' => ['required', 'array'],
            'questions.*' => ['required','string','max:250'],
            'comment' => ['required','string','max:250'],
            'min_rating' => ['required','string','max:2'],
            'average_review' => ['required','string','max:2'],
            'review_platform_id' => ['required', 'exists:rating_settings,id'],
            'property_id' => ['required', 'exists:properties,id'],
        ]);
    }

    public function report(Request $request): View
    {
        return view('survey.report');
    }
}