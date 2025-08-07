<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Property;
use App\Models\RatingSetting;
use Illuminate\Http\RedirectResponse;
use Google_Client;
use Google_Service_MyBusinessAccountManagement;
use Google_Service_MyBusinessBusinessInformation;
use Illuminate\Support\Facades\Http;
use App\Events\GoogleReviewsScrape;

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
            return redirect()->route("integrations.index")->with('status', __("Google connected!"));
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

        if($request->code) {
            $client = google_Client($ratingSetting);
            $accessToken = $client->fetchAccessTokenWithAuthCode($request->code);

            if(!empty($accessToken['error'])) {
                $message = $accessToken['error_description'];
            } else {
                $client->setAccessToken($accessToken);

                $accountService = new Google_Service_MyBusinessAccountManagement($client);
                $accounts = $accountService->accounts->listAccounts()->getAccounts();

                if (empty($accounts)) {
                    $message = __('No Google Business Profile accounts found!');
                } else {
                    $accountName = $accounts[0]->getName();

                    $locationService = new Google_Service_MyBusinessBusinessInformation($client);

                    $params = [
                        'pageSize' => 100,
                        'readMask' => ['name', 'title']
                    ];

                    $locations = $locationService->accounts_locations->listAccountsLocations($accountName, $params)->getLocations();

                    $selectedLocation = collect($locations)->first(function ($location) use ($ratingSetting) {
                        return strtolower($location->getTitle()) === strtolower($ratingSetting->name);
                    });

                    if ($selectedLocation) {
                        $ratingSetting->google_location = $selectedLocation->getName();
                        $ratingSetting->access_token = $accessToken;
                        $saved = $ratingSetting->save();

                        if($saved) {
                            event(new GoogleReviewsScrape($ratingSetting->property, $ratingSetting, false));
                        }

                        $message = $saved ? __('Google connected!') : __('Failed to connect google.');
                    } else {
                        $message = __("Google account not assigned to {$ratingSetting->name}");
                    }
                }
            }
        } else {
            $ratingSetting->access_token = null;
            $message = $ratingSetting->save() ? __('Google disconnected!') : __('Failed to disconnect google.');
        }

        return redirect()->route('integrations.index')->with('status', $message);
    }
}