<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Locale
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
        $language = \Session::get('website_language', config('app.locale'));
        // get data in session if session have not data return default in config

        config(['app.local' => $language]); 
        // translate application to client language
        
        return $next($request);
    }
}
