<?php

namespace App\Listeners\Blog;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\Blog\RecordBlog;

class BlogCountView implements ShouldQueue
{

    use InteractsWithQueue;


    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $blog = $event->blog;

        logger($blog);
    }
}
