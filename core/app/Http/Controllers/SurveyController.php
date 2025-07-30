<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class SurveyController extends Controller
{
    /**
     * Display the Survey list.
     */
    public function index(Request $request): View
    {
        return view('survey.list');
    }
    public function addsurvey(Request $request): View
    {
        
        return view('survey.add-survey');
    }
    public function report(Request $request): View
    {

        
        
        return view('survey.report');
    }
}