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
                $service_account  = new Google_Service_MyBusinessAccountManagement($client);
    
                $accountsResponse = $service_account->accounts->listAccounts();
                $accounts = $accountsResponse->getAccounts();
    
                if (empty($accounts)) {
                    $message = __('No Google Business Profile accounts found!');
                } else {
                    $accountName = $accounts[0]->getName();
    
                    $service_business = new Google_Service_MyBusinessBusinessInformation($client);
    
                    $params = [
                        'pageSize' => 100,
                        'readMask' => ['name', 'title']
                    ];
    
                    $locationsResponse = $service_business->accounts_locations->listAccountsLocations($accountName, $params);
                    $locations = $locationsResponse->getLocations();
                    $selectedLocation = [];
    
                    if (!empty($locations)) {
                        foreach ($locations as $k => $location) {
                            if (strtolower($location->getTitle()) === strtolower($ratingSetting->name)) {
                                $selectedLocation = $location->getName();
                                break;
                            }
                        }

                        if($selectedLocation) {
                            $ratingSetting->google_location = $selectedLocation;
                            $ratingSetting->access_token = $accessToken;

                            $message = $ratingSetting->save() ? __("Google ".($request->code ? "connected" : "disconnected")."!") : __("Some error occurred");
                        } else {
                            $message = __("Google Business Location Not Assigned to {$ratingSetting->name}");
                        }
                    } else {
                        $message = __('No Google Business Location found!');
                    }
                }
            }
        } else {
            $ratingSetting->access_token = null;
            $message = $ratingSetting->save() ? __("Google ".($request->code ? " " : " ")."!") : __("Some error occurred");
        }

        return redirect()->to(route('integrations.index'))->with('status', $message);
    }
}