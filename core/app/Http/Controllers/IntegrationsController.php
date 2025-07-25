<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Property;
use App\Models\RatingSetting;
use Illuminate\Http\RedirectResponse;
use Google_Client;

class IntegrationsController extends Controller
{
    /**
     * Display the Integrations list.
     */
    public function index(Request $request): View|RedirectResponse
    {
        $data['properties'] = Property::with('platforms')->where('client_id', authUser()->id)->get();
        return view('integrations.list', $data);
    }

    /**
     * Google link for the Integration.
     */
    public function google(Request $request, RatingSetting $ratingSetting): RedirectResponse
    {
        if($ratingSetting->access_token) {
            return redirect()->route("integrations.index")->with('status', __("Google integration successful!"));
        }

        $authUrl = google_Client($ratingSetting)->createAuthUrl();

        return redirect()->to($authUrl);
    }

    /**
     * Google Callback for the Integration.
     */
    public function googleCallback(Request $request)
    {
        $ratingSetting = RatingSetting::findOrFail($this->getDecodedId($request->state));

        $ratingSetting->access_token = $request->code;
        $saved = $ratingSetting->save();

        return redirect()->to(route('integrations.index'))->with('status', $saved ? __("Google ".($request->code ? "connected" : "disconnected")."!") : __("Some error occurred"));
    }
}