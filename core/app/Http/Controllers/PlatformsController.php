<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PlatformsController extends Controller
{
    /**
     * Search the platforms url.
     */
    public function search(Request $request): JsonResponse
    {
        dd($request->all());
    }
}