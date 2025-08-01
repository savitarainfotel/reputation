<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Property;

class RedirectIfNoPropertyAvailable
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $properties = Property::where('client_id', authUser()->id)->count();

        if(!$properties) {
            return redirect()->route("properties.create");
        }

        return $next($request);
    }
}
