<?php

namespace App\Listeners\Blog;
use App\Events\Blog\RecordBlog;
use Illuminate\Support\Facades\Log;
use App\Jobs\ProcessViewer;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Helpers\RedisClient;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class BlogCountView
{
    protected $redis;

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
        // hanle session check ip time view limit -> enqueue
        if (!Session::has(get_client_ip())) {
            $this->redis = new RedisClient('redis', 6379, 'ngocbao1512', '0', true, 120);
            $blog = $event->blog;
            $data_viewer['blog_id'] = $blog['id'];
            $data_viewer['user_id'] = Auth::id() ?? -1;
            $data_viewer['ip_address'] = get_client_ip();
            $data_viewer['time_view'] = Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
            $str_data_viewer = json_encode($data_viewer);
            $this->redis->Enqueue('data_viewer', $str_data_viewer);
            Session::flash(get_client_ip(), 'true');
        }

    }
}

