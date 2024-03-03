<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HttpRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // if ($request->headers->has('X-Forwarded-Proto')) {
        //     if (strcmp($request->header('X-Forwarded-Proto'), 'https') === 0) {
        //         return $next($request);
        //     }
        // }
        // if (!$request->secure() && env('APP_ENV') !== 'local') {
        // dd(env('APP_ENV'));
        // if (!$request->secure() && request()->getRequestUri() != '/health' && env('APP_ENV') !== 'local') {            
        //     return redirect()->secure($request->getRequestUri(), 301);
        // }

        return $next($request);
    }
}