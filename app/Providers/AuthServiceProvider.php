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


    protected function hasPermission(User $user, $permission )
    {
        
        $user_roles = $user->roles()->with('permissions')->get();

        $permissionIds = $user_roles->pluck('permissions')->flatten()->pluck('id')->toArray();
        return in_array($permission->id, $permissionIds);
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
            Gate::define($permission->name, function (User $user) use ($permission) {
                return $this->hasPermission($user, $permission);
            });
        }
           
    }

    
}