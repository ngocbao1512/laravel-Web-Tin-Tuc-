<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Blog;
use App\Models\User;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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


    protected function hasPermission($user, $permission )
    {
        $cache_key = "user-permission-".$user->id;
        if(Cache::get($cache_key) == null) {
            $user_roles = $user->roles()->with('permissions')->get();
            $permissionNames = $user_roles->pluck('permissions')->flatten()->pluck('name')->toArray();
            Cache::put($cache_key, $permissionNames, 60000);
        }

        $user_permissions = Cache::get($cache_key);
        
        return in_array($permission, $user_permissions);
    }

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()  
    {
        $this->registerPolicies();

        if(Cache::get('permissions') == null) {
            $permissions = Permission::pluck('name')->toArray();
                Cache::put('permissions',$permissions,60000);
        }

        $permissions = Cache::get('permissions');

        foreach ($permissions as $permission) {
            Gate::define($permission, function (User $user) use ($permission)  {
                return $this->hasPermission($user, $permission);
            });
        }
           
    }

    
}