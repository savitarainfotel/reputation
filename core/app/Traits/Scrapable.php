<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use App\Constants\Status;
use App\Models\Property;
use App\Models\Platform;

trait Scrapable
{
    /**
     * Scrape the platforms url of Agoda.
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
     * Scrape the platforms url of Booking.
     */
    public function scrapeBooking(String $requestUrl, Property $property, Platform $platform): Array
    {
        try {
            $response = Http::get($requestUrl);

            if($response->successful()){
                $crawler = new Crawler($response->body());

                $return = ["platform_url" => $requestUrl, 'status' => Status::YES];

                $titleNode = $crawler->filter('div[data-capla-component-boundary="b-property-web-property-page/PropertyHeaderName"]')->first();

                if ($titleNode->count() && !empty($titleNode->text())) {
                    $return['name']   = $titleNode->text();
                }

                $addressNode = $crawler->filter('div[data-testid="PropertyHeaderAddressDesktop-wrapper"]')->first();

                if ($addressNode->count()) {
                    $anchorNode = $addressNode->filter('a[data-atlas-latlng]')->first();

                    if ($anchorNode->count()) {
                        $buttonNode = $addressNode->filter('button')->first();

                        if ($buttonNode->count()) {
                            $divNode = $buttonNode->filter('div')->first();

                            if ($divNode->count()) {
                                $firstDivNode = $divNode->getNode(0);

                                if(!empty($firstDivNode->childNodes)) {
                                    $address = '';

                                    foreach ($firstDivNode->childNodes as $child) {
                                        if ($child->nodeType === XML_TEXT_NODE) {
                                            $address .= $child->nodeValue;
                                        }
                                    }

                                    $return['address'] = trim($address);
                                }
                            }
                        }
                    }
                }

                $imageNode = $crawler->filter('div#photo_wrapper img')->first();

                if ($imageNode->count()) {
                    $return['picture'] = $imageNode->attr('src');
                }

                return !empty($return['name']) && !empty($return['address']) && !empty($return['picture']) ? $return : ['message' => __("Unsupported platform URL.")];
            } else {
                return ['message' => __("Unsupported platform URL.")];
            }
        } catch (\Exception $e) {
            return ['message' => __("Unsupported platform URL.")];
        }
    }

    /**
     * Scrape the platforms url of Expedia.
     */
    public function scrapeExpedia(String $requestUrl, Property $property, Platform $platform): Array
    {
        try {
            $response = Http::get("https://api.scraperapi.com/?api_key=".gs('scraper-api')."&url=".$requestUrl);

            if($response->successful()){
                $crawler = new Crawler($response->body());

                $return = ["platform_url" => $requestUrl, 'status' => Status::YES];

                $titleNode = $crawler->filter('h1[class="uitk-heading uitk-heading-3"]')->first();

                if ($titleNode->count() && !empty($titleNode->text())) {
                    $return['name'] = $titleNode->text();
                }

                $addressNode = $crawler->filter('div[class="uitk-text uitk-type-start uitk-type-300 uitk-text-default-theme"]')->first();

                if ($addressNode->count() && !empty($addressNode->text())) {
                    $return['address'] = $addressNode->text();
                }

                $imageNode = $crawler->filter('section#Overview img')->first();

                if ($imageNode->count()) {
                    $return['picture'] = $imageNode->attr('src');
                }

                return !empty($return['name']) && !empty($return['address']) && !empty($return['picture']) ? $return : ['message' => __("Unsupported platform URL.")];
            } else {
                return ['message' => __("Unsupported platform URL.")];
            }
        } catch (\Exception $e) {
            return ['message' => __("Unsupported platform URL.")];
        }
    }
}