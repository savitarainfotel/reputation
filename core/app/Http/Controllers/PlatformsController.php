<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Property;
use App\Models\Platform;
use App\Constants\Status;
use Illuminate\Support\Str;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

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
        try {
            $response = Http::get($requestUrl);

            if($response->successful()){
                $crawler = new Crawler($response->body());

                $scriptNode = $crawler->filter('script[data-selenium="script-initparam"]')->first();

                if($scriptNode->count() && !empty($scriptNode->text())) {
                    if (preg_match('/var\s+apiUrl\s*=\s*"([^"]+)"/', $scriptNode->text(), $matches)) {
                        $apiUrl = $matches[1] ?? null;
                        
                        if($apiUrl) {
                            $response = Http::get("https://www.agoda.com/{$apiUrl}");

                            if($response->successful()){
                                $hotel = $response->json();

                                $images = collect(data_get($hotel, 'mosaicInitData.images', []))->first();

                                return [
                                    "name"         => data_get($hotel, 'hotelInfo.name'),
                                    "address"      => data_get($hotel, 'hotelInfo.address.full'),
                                    "picture"      => $images['location'] ?? null,
                                    "platform_url" => $requestUrl,
                                    "status"       => Status::YES
                                ];
                            } else {
                                return ['message' => __("Unsupported platform URL.")];
                            }
                        } else {
                            return ['message' => __("Unsupported platform URL.")];
                        }
                    } else {
                        return ['message' => __("Unsupported platform URL.")];
                    }
                } else {
                    return ['message' => __("Unsupported platform URL.")];
                }
            } else {
                return ['message' => __("Unsupported platform URL.")];
            }
        } catch (\Exception $e) {
            return ['message' => __("Unsupported platform URL.")];
        }
    }

    /**
     * Show the form for creating or updating a new resource.
     */
    public function addOrUpdate(Request $request, Property $property, Platform $platform): JsonResponse
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        if ($request->isMethod('get')) {
            $data['property'] = $property;
            $data['platform'] = $platform;
            $platforms        = Platform::where('exclude', Status::NO)->where('is_default', Status::NO)->where('is_delete', Status::NO);
            $ratingPlatforms  = $property->platforms->pluck('rating_platform_id');

            if($ratingPlatforms->count()) {
                $platforms->whereNotIn('id', $ratingPlatforms);
            }

            $data['platforms'] = $platforms->get();

            $view = view('platforms.form', $data)->render();
            $title = __($platform->exists ? __('Update listing') : __('Add listing'));

            return response()->json(['html' => $view, 'title' => $title, 'triggerMethod' => $platform->exists ? '' : 'initSelectWithLogo']);
        }

        if ($request->isMethod('post')) {
            return $this->processForm($request, $property, $platform);
            // "platform_id" => "gw2qnwgv-kd79-em1n-93oj-8ylx4zr6p59y"
            // "name" => "The Leela Ambience Convention Hotel Delhi"
            // "address" => "1,CBD, Maharaja Surajmal Road, Near Yamuna Sports Complex, East Delhi, New Delhi and NCR, India, 110032"
            // "picture" => "//pix8.agoda.net/hotelImages/393/393148/393148_13061319270013033438.jpg?ca=0&ce=1&s=1024x768"
            // "platform_url" => "https://www.agoda.com/en-in/the-leela-ambience-convention-hotel/hotel/new-delhi-and-ncr-in.html"
            // return $this->processForm($request, $property);
        }
    }
    
    /**
     * Process the resource in storage.
     */
    private function processForm(Request $request, Property $property, Platform $platform): JsonResponse
    {
        $this->validateRequest($request, $property, $platform);
        
        $ratingSetting = new RatingSetting();
        $ratingSetting->name = $request->name;
        $ratingSetting->address = $request->address;
        $ratingSetting->property_id = $property->id;
        $ratingSetting->rating_platform_id = $platform->id;
        $ratingSetting->status = Status::YES;
        $ratingSetting->min_rating = 4;
        $ratingSetting->average_review = 4;
        $ratingSetting->rating_url = $request->platform_url;
        // $ratingSetting->save();

        event(new ImageDownload($request->image_url, $property));

        $ratingSetting = new RatingSetting();
        
        $ratingSetting->property_id = $property->id;
        $ratingSetting->rating_platform_id = $platform->id;
        $ratingSetting->status = Status::YES;
        $ratingSetting->min_rating = 4;
        $ratingSetting->average_review = 4;
        $ratingSetting->rating_url = "https://search.google.com/local/writereview?placeid={$request->place_id}";
        $ratingSetting->save();

        event(new ImageDownload($request->image_url, $property, $ratingSetting));

        $message = $saved
            ? ['message' => __("Property added successfully"), 'redirect' => route('properties.add.platforms', $property)]
            : ['message' => __("Some error occurred")];

        return response()->json($message);
    }

    /**
     * Validate the resource.
     */
    private function validateRequest(Request $request, Property $property, Platform $platform)
    {
        if (!$property->exists) {
            $request->validate([
                'name' => ['required','string','max:250'],
                'address' => ['required','string','max:250'],
                'picture' => ['required','string'],
                'platform_url' => ['required','string','max:250'],
                'platform_id' => ['required', 'string']
            ]);
        }
    }
}