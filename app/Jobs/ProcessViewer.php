<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class ProcessViewer implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $data_viewer;

    public $tries = 5;

    public function retryUntil()
    {
        return now()->addMinutes(5);
    }

    public $timeout = 120;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data_viewer)
    {
        $this->data_viewer = $data_viewer;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // save into database
        DB::table('blog_views')->insert($this->data_viewer);
    }
}
