<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Blog;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class AuthServiceProvider extends ServiceProvider
{
    protected $modelPermission;

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];


    protected function hasPermission(User $user, Blog $blog, $permission = null)
    {
        $check_permission = false;
        $user_roles = auth()->user()->roles;

        foreach ($user_roles as $role) {
            foreach ($role->permissions as $permission_user) {
                if($permission == $permission_user->name) {
                    $check_permission = true;
                }
            }
        }
       

        return $user->id == $blog->created_user_id || ($check_permission == true);
    }

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $permissions = Permission::all();

        foreach ($permissions as $permission) {
            Gate::define($permission->name, function (User $user, Blog $blog) use ($permission) {
                return $this->hasPermission($user, $blog, $permission->name);
            });
        }
           
    }

    
}


/*
function (User $user, Blog $blog) {
                return $this->hasPermission($user, $blog, $permission->name);
            });
