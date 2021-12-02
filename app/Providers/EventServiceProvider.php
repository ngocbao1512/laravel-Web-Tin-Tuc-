<?php

namespace App\Providers;

use App\Listeners\Blog\BlogEmailNotifications;
use Illuminate\Auth\Events\Registered;
use App\Events\Blog\BlogCreate;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use function Illuminate\Events\queueable;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        BlogCreate::class => [
            BlogEmailNotifications::class,
        ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen(queueable(function (BlogCreate $event) {
          //
        })->onConnection('redis')->onQueue('blog')->delay(now()->addSecond(10)));

    }
}















