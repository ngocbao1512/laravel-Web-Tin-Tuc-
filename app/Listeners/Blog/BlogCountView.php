<?php

namespace App\Listeners\Blog;
use App\Events\Blog\RecordBlog;
use Illuminate\Support\Facades\Log;

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
    }
}
