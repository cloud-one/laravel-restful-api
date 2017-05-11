<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AlwaysExpectsJson
{
    /**
     * Handle an incoming request to always expects json.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $request->headers->add(['Accept' => 'application/json']);

        return $next($request);
    }
}
