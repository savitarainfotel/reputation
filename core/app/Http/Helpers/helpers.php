<?php

use App\Constants\Status;
use App\Models\Role;
use Carbon\Carbon;
use App\Lib\FileManager;
use App\Models\GeneralSetting;
use App\Models\RatingSetting;
use Illuminate\Support\Facades\Route;

if (!function_exists('generate_datatables')) {
    function generate_datatables(&$data) {
        $data['data'] = array_map(function ($item) {
            return array_values($item);
        }, $data['data']);

        return response()->json($data);
    }
}

if (!function_exists('sortDataTables')) {
    function sortDataTables($orderColumns, $query, $default = 'DESC', $defaultColumn = 'id') {
        $order = request()->input('order');

        if (is_array($order) && isset($order[0]['column'], $order[0]['dir'])) {
            $columnIndex = (int) $order[0]['column'];
            $direction = strtolower($order[0]['dir']) === 'asc' ? 'ASC' : 'DESC';
            if (array_key_exists($columnIndex, $orderColumns) && $orderColumns[$columnIndex]) {
                $query->orderBy($orderColumns[$columnIndex], $direction);
            } else {
                $query->orderBy($defaultColumn, $default);
            }
        } else {
            $query->orderBy($defaultColumn, $default);
        }
    }
}

if (!function_exists('showActions')) {
    function showActions($html = '') {
        return '<td class="text-center"><ul class="table-controls">' .$html. '</ul></td>';
    }
}

if (!function_exists('get_link')) {
    function get_link($can, $method, $action) {
        $link  = '<li>';

        if($can) {
            switch ($method) {
                case 'edit':
                    $link  = '<a data-action="'.$action.'" href="javascript:void(0);" class="bs-tooltip general-modal-button" data-bs-toggle="tooltip" data-bs-placement="top" data-original-title="'.__('Edit').'" aria-label="'.__('Edit').'" data-bs-original-title="'.__('Edit').'"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-8 mb-1"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>';
                    break;

                case 'active':
                    $link  = '<a data-action="'.$action.'" href="javascript:void(0);" class="bs-tooltip change-status" data-bs-toggle="tooltip" data-bs-placement="top" data-original-title="'.__('Mark Active').'" aria-label="'.__('Mark Active').'" data-bs-original-title="'.__('Mark Active').'">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20.1818 9.36364H14.4455L15.3091 5.20909L15.3364 4.91818C15.3364 4.54545 15.1818 4.2 14.9364 3.95455L13.9727 3L7.99091 8.99091C7.65455 9.31818 7.45455 9.77273 7.45455 10.2727V19.3636C7.45455 20.3636 8.27273 21.1818 9.27273 21.1818H17.4545C18.2091 21.1818 18.8545 20.7273 19.1273 20.0727L21.8727 13.6636C21.9545 13.4545 22 13.2364 22 13V11.1818C22 10.1818 21.1818 9.36364 20.1818 9.36364Z" fill="#000000"></path>
                                    <path d="M5.63636 10.2727H2V21.1818H5.63636V10.2727Z" fill="#000000"></path>
                                </svg>
                            </a>';
                    break;

                case 'inactive':
                    $link  = '<a data-action="'.$action.'" href="javascript:void(0);" class="bs-tooltip change-status" data-bs-toggle="tooltip" data-bs-placement="top" data-original-title="'.__('Mark Inactive').'" aria-label="'.__('Mark Inactive').'" data-bs-original-title="'.__('Mark Inactive').'">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.7273 3H6.54545C5.79091 3 5.14545 3.45455 4.87273 4.10909L2.12727 10.5182C2.04545 10.7273 2 10.9455 2 11.1818V13C2 14 2.81818 14.8182 3.81818 14.8182H9.55455L8.69091 18.9727L8.66364 19.2636C8.66364 19.6364 8.81818 19.9818 9.06364 20.2273L10.0273 21.1818L16.0091 15.1909C16.3455 14.8636 16.5455 14.4091 16.5455 13.9091V4.81818C16.5455 3.81818 15.7273 3 14.7273 3Z" fill="#000000"/>
                                    <path d="M22 3H18.3636V13.9091H22V3Z" fill="#000000"/>
                                </svg>
                            </a>';
                    break;

                case 'delete':
                    $link  = '<a href="'.$action.'" class="bs-tooltip" data-bs-toggle="tooltip" data-bs-placement="top" data-original-title="'.__('Delete').'" aria-label="'.__('Delete').'" data-bs-original-title="'.__('Delete').'"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash p-1 br-8 mb-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a>';
                    break;
            }
        }

        return $link.'</li>';
    }
}

function showDate($date) {
    return Carbon::parse($date)->format('m/d/Y');
}

function addSpaceToCamelCase($string) {
    return trim(preg_replace('/([a-z])([A-Z])/', '$1 $2', Str::replaceLast('Controller', '', $string)));
}

function authUser() {
    return auth()->user();
}

function getFilePath($key) {
    return fileManager()->$key()->path;
}

function fileManager() {
    return new FileManager();
}

function showActive($route) {
    return Route::currentRouteName() === $route ? 'active' : '';
}

function gs($key = null) {
    $general = $general = GeneralSetting::where('setting_key', $key)->first();
    return @$general->setting_value;
}

function google_Client(RatingSetting $ratingSetting) {
    $client = new Google_Client();
    $client->setClientId(gs('google-client-id'));
    $client->setClientSecret(gs('google-client-secret'));
    $client->setRedirectUri(route('integrations.google.callback'));
    $client->setAccessType('offline');
    $client->setIncludeGrantedScopes(true);
    $client->addScope(Status::GOOGLE_SCOPES);
    $client->setState($ratingSetting->encID);

    return $client;
}

if ( ! function_exists('getBackgroundForAlphabet')) {
    function getBackgroundForAlphabet($alpha='') {
        $alpha = strtoupper(substr($alpha, 0, 1));

        $colors = [
                    'A' => 'F44336', 'B' => 'E91E63', 'C' => '9C27B0', 'D' => '673AB7', 'E' => '3F51B5',
                    'F' => '2196F3', 'G' => '03A9F4', 'H' => '00BCD4', 'I' => '009688', 'J' => '4CAF50',
                    'K' => '8BC34A', 'L' => 'CDDC39', 'M' => 'C7B834', 'N' => 'FFC107', 'O' => 'FF9800',
                    'P' => 'FF5722', 'Q' => '795548', 'R' => '9E9E9E', 'S' => '607D8B', 'T' => '333333',
                    'U' => 'CE7A7A', 'V' => '000000', 'W' => 'FF00FF', 'X' => 'FFC0CB', 'Y' => 'FFA500',
                    'Z' => 'B8B839'
                ];

        return '#'.(isset($colors[$alpha]) ? $colors[$alpha] : $colors["A"]);
    }
}

if ( ! function_exists('getUserImageOrAlpha')) {
    function getUserImageOrAlpha($review) {
        return !empty($review->reviewer_picture) ? 
                    '<img src="'.$review->reviewer_picture.'" alt="" class="stepper-circle me-2" />' : 
                    '<strong class="stepper-circle me-2 text-white fs-4" style="background: '.getBackgroundForAlphabet($review->reviewer).'">'.strtoupper(substr($review->reviewer, 0, 1)).'</strong>';
    }
}

if ( ! function_exists('lineCounts')) {
    function lineCounts($text = null) {
        $normalized = str_replace(["\r\n", "\r"], "\n", ($text ?? null));
        $lines = explode("\n", $normalized);
        return count($lines) + 1;
    }
}

if ( ! function_exists('calculateResponseRate')) {
    function calculateResponseRate($reviews) {
        return ceil((clone $reviews)->where('is_answered', Status::YES)->count() / (clone $reviews)->count() * 100);
    }
}