<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\View\Components\ClientMenu;
use App\View\Components\AdminMenu;
use App\View\Components\AlertDelete;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \App\Repositories\User\UserRepositoryInterface::class,
            \App\Repositories\User\UserRepository::class,
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('client-menu', ClientMenu::class);
        Blade::component('admin-menu', AdminMenu::class);
        Blade::component('alert-delete',AlertDelete::class);
        Blade::component('form-user',FormUser::class);
    }
}
