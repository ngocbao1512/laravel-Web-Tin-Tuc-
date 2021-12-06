<?php

namespace App\Console\Commands;

use App\Helpers\RedisClient;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateViewer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'save:viewer {quantity?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $quantity = $this->argument('quantity') ?? 50;
        $redis = new RedisClient('redis', 6379, 'ngocbao1512', '0', true, 120);
        $arr_data = array();
        if(count($arr_data)>0)
        {
            for ($i = 0; $i < $quantity; $i++) {
                $queue = json_decode($redis->Dequeue('data_viewer'));
                array_push($arr_data, array(
                    'blog_id' => $queue->blog_id,
                    'user_id' => $queue->user_id,
                    'ip_address' => $queue->ip_address,
                    'time_view' => $queue->time_view,
                ));
            }
        }

        if (count($arr_data) <= $quantity)
        {
            DB::table('blog_views')->insert($arr_data);
        }
        $this->info($redis->Dequeue('data_viewer'));
        return Command::SUCCESS;
    }
}
