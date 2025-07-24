<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class RatingReplyController extends Controller
{
    /**
     * Display the properties list.
     */
    public function index(Request $request): View
    {
        return view('rating-reply.list');
    }
}