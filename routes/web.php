<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubCategoryController;
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
        ->middleware('view-roles');
    Route::get('/roles/{role}', [RoleController::class, 'show'])
        ->name('web.roles.show')
        ->middleware('view-roles');
    Route::post('/roles', [RoleController::class, 'store'])
        ->name('web.roles.store')
        ->middleware('create-role');
    Route::patch('/roles/{role}', [RoleController::class, 'update'])
        ->name('web.roles.update')
        ->middleware('update-role');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])
        ->name('web.roles.destroy')
        ->middleware('delete-role');

    Route::get('/permissions', [PermissionController::class, 'index'])
        ->name('web.permissions.index')
        ->middleware('view-permissions');
    Route::get('/permissions/{permission}', [PermissionController::class, 'show'])
        ->name('web.permissions.show')
        ->middleware('view-permissions');

    Route::get('/users/search', [UserController::class, 'search'])
        ->name('web.users.search')
        ->middleware('view-users');
    Route::get('/users', [UserController::class, 'index'])
        ->name('web.users.index')
        ->middleware('view-users');
    Route::get('/users/{user}', [UserController::class, 'show'])
        ->name('web.users.show')
        ->middleware('view-users');
    Route::post('/users', [UserController::class, 'store'])
        ->name('web.users.store')
        ->middleware('create-user');
    Route::patch('/users/{user}', [UserController::class, 'update'])
        ->name('web.users.update')
        ->middleware('update-user');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])
        ->name('web.users.destroy')
        ->middleware('delete-user');

    Route::get('/categories', [CategoryController::class, 'index'])
        ->name('web.categories.index')
        ->middleware('view-categories');
    Route::get('/categories/{category}', [CategoryController::class, 'show'])
        ->name('web.categories.show')
        ->middleware('view-categories');
    Route::post('/categories', [CategoryController::class, 'store'])
        ->name('web.categories.store')
        ->middleware('create-category');
    Route::patch('/categories/{category}', [CategoryController::class, 'update'])
        ->name('web.categories.update')
        ->middleware('update-category');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])
        ->name('web.categories.destroy')
        ->middleware('delete-category');

    Route::get('/sub-categories/{subCategory}', [SubCategoryController::class, 'show'])
        ->name('web.sub-categories.show')
        ->middleware('view-categories');
    Route::post('/sub-categories', [SubCategoryController::class, 'store'])
        ->name('web.sub-categories.store')
        ->middleware('create-category');
    Route::patch('/sub-categories/{subCategory}', [SubCategoryController::class, 'update'])
        ->name('web.sub-categories.update')
        ->middleware('update-category');
    Route::delete('/sub-categories/{subCategory}', [SubCategoryController::class, 'destroy'])
        ->name('web.sub-categories.destroy')
        ->middleware('delete-category');

    Route::get('/products/search', [ProductController::class, 'search'])
        ->name('web.products.search')
        ->middleware('view-products');
    Route::get('/products', [ProductController::class, 'index'])
        ->name('web.products.index')
        ->middleware('view-products');
    Route::get('/products/{product}', [ProductController::class, 'show'])
        ->name('web.products.show')
        ->middleware('view-products');
    Route::post('/products', [ProductController::class, 'store'])
        ->name('web.products.store')
        ->middleware('create-product');
    Route::patch('/products/{product}', [ProductController::class, 'update'])
        ->name('web.products.update')
        ->middleware('update-product');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])
        ->name('web.products.destroy')
        ->middleware('delete-product');
});

require __DIR__ . '/auth.php';
