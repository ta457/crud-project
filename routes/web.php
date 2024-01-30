<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Permission;
use App\Http\Controllers\PermissionController;
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
    Route::post('/roles', [RoleController::class, 'store'])->name('web.roles.store');
    Route::patch('/roles/{role}', [RoleController::class, 'update'])->name('web.roles.update');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('web.roles.destroy');

    Route::get('/permissions', [PermissionController::class, 'index'])->name('web.permissions.index');
    Route::post('/permissions', [PermissionController::class, 'store'])->name('web.permissions.store');
    Route::patch('/permissions/{permission}', [PermissionController::class, 'update'])->name('web.permissions.update');
    Route::delete('/permissions/{permission}', [PermissionController::class, 'destroy'])->name('web.permissions.destroy');
});

require __DIR__.'/auth.php';
