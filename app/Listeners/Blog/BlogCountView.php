<?php

namespace App\Listeners\Blog;
use App\Events\Blog\RecordBlog;
use Illuminate\Support\Facades\Log;
use App\Jobs\ProcessViewer;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BlogCountView
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * @param RecordBlog $event
     */
    public function handle(RecordBlog $event)
    {
        $blog = $event->blog;

        $data_viewer['blog_id'] = $blog['id'];
        $data_viewer['user_id'] = Auth::id() ?? -1;
        $data_viewer['ip_address'] = get_client_ip();
        $data_viewer['time_view'] = Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
        ProcessViewer::dispatch($data_viewer)->delay(now()->addMinutes(2));
    }
}
