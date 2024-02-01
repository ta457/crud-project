<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('view-roles', function (User $user) {
            return $user->hasPermission('view-roles');
        });
        Gate::define('create-role', function (User $user) {
            return $user->hasPermission('create-role');
        });
        Gate::define('update-role', function (User $user) {
            return $user->hasPermission('update-role');
        });
        Gate::define('delete-role', function (User $user) {
            return $user->hasPermission('delete-role');
        });

        Gate::define('view-permissions', function (User $user) {
            return $user->hasPermission('view-permissions');
        });
        Gate::define('create-permission', function (User $user) {
            return $user->hasPermission('create-permission');
        });
        Gate::define('update-permission', function (User $user) {
            return $user->hasPermission('update-permission');
        });
        Gate::define('delete-permission', function (User $user) {
            return $user->hasPermission('delete-permission');
        });

        Gate::define('view-users', function (User $user) {
            return $user->hasPermission('view-users');
        });
        Gate::define('create-user', function (User $user) {
            return $user->hasPermission('create-user');
        });
        Gate::define('update-user', function (User $user) {
            return $user->hasPermission('update-user');
        });
        Gate::define('delete-user', function (User $user) {
            return $user->hasPermission('delete-user');
        });
    }
}
