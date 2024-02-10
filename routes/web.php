<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/roles', [RoleController::class, 'index'])
        ->name('web.roles.index')
        ->middleware('check-permission:view-roles');
    Route::get('/roles/{role}', [RoleController::class, 'show'])
        ->name('web.roles.show')
        ->middleware('check-permission:view-roles');
    Route::post('/roles', [RoleController::class, 'store'])
        ->name('web.roles.store')
        ->middleware('check-permission:create-role');
    Route::patch('/roles/{role}', [RoleController::class, 'update'])
        ->name('web.roles.update')
        ->middleware('check-permission:update-role');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])
        ->name('web.roles.destroy')
        ->middleware('check-permission:delete-role');

    Route::get('/permissions', [PermissionController::class, 'index'])
        ->name('web.permissions.index')
        ->middleware('check-permission:view-permissions');
    Route::get('/permissions/{permission}', [PermissionController::class, 'show'])
        ->name('web.permissions.show')
        ->middleware('check-permission:view-permissions');

    Route::post('/users/search', [UserController::class, 'search'])
        ->name('web.users.search')
        ->middleware('check-permission:view-users');
    Route::get('/users', [UserController::class, 'index'])
        ->name('web.users.index')
        ->middleware('check-permission:view-users');
    Route::get('/users/{user}', [UserController::class, 'show'])
        ->name('web.users.show')
        ->middleware('check-permission:view-users');
    Route::post('/users', [UserController::class, 'store'])
        ->name('web.users.store')
        ->middleware('check-permission:create-user');
    Route::patch('/users/{user}', [UserController::class, 'update'])
        ->name('web.users.update')
        ->middleware('check-permission:update-user');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])
        ->name('web.users.destroy')
        ->middleware('check-permission:delete-user');

    Route::get('/categories', [CategoryController::class, 'index'])
        ->name('web.categories.index')
        ->middleware('check-permission:view-categories');
    Route::get('/categories/{category}', [CategoryController::class, 'show'])
        ->name('web.categories.show')
        ->middleware('check-permission:view-categories');
    Route::post('/categories', [CategoryController::class, 'store'])
        ->name('web.categories.store')
        ->middleware('check-permission:create-category');
    Route::patch('/categories/{category}', [CategoryController::class, 'update'])
        ->name('web.categories.update')
        ->middleware('check-permission:update-category');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])
        ->name('web.categories.destroy')
        ->middleware('check-permission:delete-category');

    Route::get('/products/search', [ProductController::class, 'search'])
        ->name('web.products.search')
        ->middleware('check-permission:view-products');
    Route::post('/products/search', [ProductController::class, 'search'])
        ->name('web.products.search')
        ->middleware('check-permission:view-products');
    Route::get('/products', [ProductController::class, 'index'])
        ->name('web.products.index')
        ->middleware('check-permission:view-products');
    Route::post('/products', [ProductController::class, 'store'])
        ->name('web.products.store')
        ->middleware('check-permission:create-product');
    Route::patch('/products/{product}', [ProductController::class, 'update'])
        ->name('web.products.update')
        ->middleware('check-permission:update-product');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])
        ->name('web.products.destroy')
        ->middleware('check-permission:delete-product');
});

require __DIR__ . '/auth.php';
