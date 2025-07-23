<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Property;
use App\Models\Platform;

class PlatformsController extends Controller
{
    /**
     * Search the platforms url.
     */
    public function search(Request $request, Property $property, Platform $platform): JsonResponse
    {
        if(!empty($request->platform[$platform->enc_id])) {
            $requestUrl = $request->platform[$platform->enc_id];
            $platformUrlHost = parse_url($platform->platform_url ?? '')['host'] ?? '';
            $requestUrlHost = parse_url($requestUrl ?? '')['host'] ?? '';

            if($platformUrlHost === $requestUrlHost) {
                switch ($platformUrlHost) {
                    case 'www.agoda.com':
                        $message = $this->scrapeAgoda($requestUrl, $property, $platform);
                        break;

                    case 'www.booking.com':
                        $message = $this->scrapeBooking($requestUrl, $property, $platform);
                        break;

                    case 'www.expedia.com':
                        $message = $this->scrapeExpedia($requestUrl, $property, $platform);
                        break;

                    default:
                        $message = ['message' => __("Invalid platform selected.")];
                        break;
                }
            } else {
                $message = ['message' => __("Invalid platform selected.")];
            }
        } else {
            $message = ['message' => __("Unsupported platform URL")];
        }

        return response()->json($message);
    }

    /**
     * Scrape the platforms url.
     */
    public function scrapeAgoda(String $requestUrl, Property $property, Platform $platform): Array
    {
        echo $requestUrl;
        dd($property);
    }
}