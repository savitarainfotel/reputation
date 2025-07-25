<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class PropertyController extends Controller
{
    /**
     * Display the properties list.
     */
    public function index(Request $request): View
    {
        return view('property.list');
    }
}