<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Session;

class Filter
{
    private $session;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function __construct(Store $session){
        $this->session = $session;
    }

    public function handle(Request $request, Closure $next)
    {
        $blogs = $this->getViewedBlogs();

        if(!is_null($blogs))
        {
            $blogs = $this->cleanExpiredViews($blogs);
            $this->storeBlogsView($blogs);
        }
        return $next($request);
    }

    private function getViewedBlogs()
    {
        return $this->session->get('viewed_blogs', null);
    }

    private function cleanExpiredViews($blogs)
    {
        $time = time();

        // Let the views expire after one hour.
        $throttleTime = 3600;

        return array_filter($blogs, function ($timestamp) use ($time, $throttleTime)
        {
            return ($timestamp + $throttleTime) > $time;
        });
    }

    private function storeBlogsView($blogs)
    {
        $this->session->put('viewed_blogs', $blogs);
    }

}
