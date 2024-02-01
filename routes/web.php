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
    Route::get('/roles', [RoleController::class, 'index'])->name('web.roles.index');
    Route::get('/roles/{role}', [RoleController::class, 'show'])->name('web.roles.show');
    Route::post('/roles', [RoleController::class, 'store'])->name('web.roles.store');
    Route::patch('/roles/{role}', [RoleController::class, 'update'])->name('web.roles.update');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('web.roles.destroy');

    Route::get('/permissions', [PermissionController::class, 'index'])->name('web.permissions.index');
    Route::get('/permissions/{permission}', [PermissionController::class, 'show'])->name('web.permissions.show');
    Route::post('/permissions', [PermissionController::class, 'store'])->name('web.permissions.store');
    Route::patch('/permissions/{permission}', [PermissionController::class, 'update'])->name('web.permissions.update');
    Route::delete('/permissions/{permission}', [PermissionController::class, 'destroy'])->name('web.permissions.destroy');

    Route::get('/users/search', [UserController::class, 'search'])->name('web.users.search');
    Route::get('/users', [UserController::class, 'index'])->name('web.users.index');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('web.users.show');
    Route::post('/users', [UserController::class, 'store'])->name('web.users.store');
    Route::patch('/users/{user}', [UserController::class, 'update'])->name('web.users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('web.users.destroy');

    Route::get('/categories', [CategoryController::class, 'index'])->name('web.categories.index');
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('web.categories.show');
    Route::post('/categories', [CategoryController::class, 'store'])->name('web.categories.store');
    Route::patch('/categories/{category}', [CategoryController::class, 'update'])->name('web.categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('web.categories.destroy');

    Route::get('/categories/{category}/sub-categories', [SubCategoryController::class, 'index'])->name('web.sub-categories.index');
    Route::get('/categories/{category}/sub-categories/{subCategory}', [SubCategoryController::class, 'show'])->name('web.sub-categories.show');
    Route::post('/categories/{category}/sub-categories', [SubCategoryController::class, 'store'])->name('web.sub-categories.store');
    Route::patch('/categories/{category}/sub-categories/{subCategory}', [SubCategoryController::class, 'update'])->name('web.sub-categories.update');
    Route::delete('/categories/{category}/sub-categories/{subCategory}', [SubCategoryController::class, 'destroy'])->name('web.sub-categories.destroy');

    Route::get('/products/search', [ProductController::class, 'search'])->name('web.products.search');
    Route::get('/products', [ProductController::class, 'index'])->name('web.products.index');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('web.products.show');
    Route::post('/products', [ProductController::class, 'store'])->name('web.products.store');
    Route::patch('/products/{product}', [ProductController::class, 'update'])->name('web.products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('web.products.destroy');
});

require __DIR__.'/auth.php';
