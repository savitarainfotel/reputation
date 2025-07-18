<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class IntegrationsController extends Controller
{
    /**
     * Display the Integrations list.
     */
    public function index(Request $request): View
    {
        
        return view('integrations.list');
    }
}