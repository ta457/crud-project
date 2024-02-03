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
        $this->defineGates([
            'view-roles', 'create-role', 'update-role', 'delete-role',
            'view-permissions',
            'view-users', 'create-user', 'update-user', 'delete-user',
            'view-categories', 'create-category', 'update-category', 'delete-category',
            'view-products', 'create-product', 'update-product', 'delete-product',
        ]);
    }

    private function defineGates(array $permissions): void
    {
        foreach ($permissions as $permission) {
            Gate::define($permission, function (User $user) use ($permission) {
                return $user->hasPermission($permission);
            });
        }
    }
}
