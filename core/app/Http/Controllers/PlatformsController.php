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
                                    "name"      => data_get($hotel, 'hotelInfo.name'),
                                    "address"   => data_get($hotel, 'hotelInfo.address.full'),
                                    "picture"   => $images['location'] ?? null,
                                    "status"    => Status::YES
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
            dd($request->all());
            // return $this->processForm($request, $property);
        }
    }
}