<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Str;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create {--user_name=} {--email=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user';

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
        $user_name = $this->argument('user_name') ?? Str::random(5);
        $email = $this->argument('email') ?? Str::random(5).'@gmail.com';
        User::create([
            'first_name' => Str::random(4),
            'middle_name' => Str::random(3),
            'last_name' => Str::random(4),
            'email' => $email,
            'user_name' => $user_name,
            'password' => Str::random(12),
        ]);

        $this->info('Create User Success!!!'.' email:'.$email.' |user_name : '.$user_name);
        return Command::SUCCESS;
    }
}
