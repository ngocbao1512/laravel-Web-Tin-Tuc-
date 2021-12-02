<?php

namespace App\Listeners\Blog;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Blog;

class BlogEmailNotifications implements ShouldQueue
{
    use InteractsWithQueue;

    public $blog;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Blog $blog)
    {
        $this->blog = $blog;
    }

    /**
     * The name of the connection the job should be sent to.
     *
     * @var string|null
     */
    public $connection = 'sqs';

    /**
     * The name of the queue the job should be sent to.
     *
     * @var string|null
     */
    public $queue = 'listeners';


    /**
     * The time (seconds) before the job should be processed.
     *
     * @var int
     */
    public $delay = 60;

    public function viaQueue()
    {
        return 'listeners';
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(BlogCreate $event)
    {
     $blog = $event->modelBlog;
     // send notification here
     logger($blog);

        if (true) {
            $this->release($this->delay);
        }
    }

    public function shouldQueue(BlogCreate $event)
    {
        return $event;
    }
}
