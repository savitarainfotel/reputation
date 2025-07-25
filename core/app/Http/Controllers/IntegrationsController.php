<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Property;
use Illuminate\Http\RedirectResponse;

class IntegrationsController extends Controller
{
    /**
     * Display the Integrations list.
     */
    public function index(Request $request): View|RedirectResponse
    {
        $data['properties'] = Property::where('client_id', authUser()->id)->get();
        return view('integrations.list', $data);
    }
}