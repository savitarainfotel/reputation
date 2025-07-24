<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ReplyReviewController extends Controller
{
    /**
     * Display the properties list.
     */
    public function index(Request $request): View
    {
        return view('reply-review.list');
    }
}