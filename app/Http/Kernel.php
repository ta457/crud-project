<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use App\Http\Middleware\MustBeAdmin;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            \Illuminate\Routing\Middleware\ThrottleRequests::class.':api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's middleware aliases.
     *
     * Aliases may be used instead of class names to conveniently assign middleware to routes and groups.
     *
     * @var array<string, class-string|string>
     */
    protected $middlewareAliases = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'precognitive' => \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class,
        'signed' => \App\Http\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,

        'view-roles' => \App\Http\Middleware\Roles\ViewRoles::class,
        'create-role' => \App\Http\Middleware\Roles\CreateRole::class,
        'update-role' => \App\Http\Middleware\Roles\UpdateRole::class,
        'delete-role' => \App\Http\Middleware\Roles\DeleteRole::class,

        'view-permissions' => \App\Http\Middleware\Permissions\ViewPermissions::class,

        'view-users' => \App\Http\Middleware\Users\ViewUsers::class,
        'create-user' => \App\Http\Middleware\Users\CreateUser::class,
        'update-user' => \App\Http\Middleware\Users\UpdateUser::class,
        'delete-user' => \App\Http\Middleware\Users\DeleteUser::class,

        'view-categories' => \App\Http\Middleware\Categories\ViewCategories::class,
        'create-category' => \App\Http\Middleware\Categories\CreateCategory::class,
        'update-category' => \App\Http\Middleware\Categories\UpdateCategory::class,
        'delete-category' => \App\Http\Middleware\Categories\DeleteCategory::class,

        'view-products' => \App\Http\Middleware\Products\ViewProducts::class,
        'create-product' => \App\Http\Middleware\Products\CreateProduct::class,
        'update-product' => \App\Http\Middleware\Products\UpdateProduct::class,
        'delete-product' => \App\Http\Middleware\Products\DeleteProduct::class,
    ];
}
