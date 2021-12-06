<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('superadmin')
    ->middleware(['auth'])
    ->name('admin.')
    ->group(function () {
        Route::get('/', DashboardController::class)
            ->name('dashboard')
            ->can('view-dashboard');
        Route::get('/dashboard', DashboardController::class)
            ->name('dashboard')
            ->can('view-dashboard');;
        Route::resource('users', UserController::class);
        Route::post('users/{user}/assign-role', [UserController::class, 'assignRole'])
            ->name('users.assign-role');
        //Route::get('/updateprofile', DashboardController::class, 'updateProfile')->name('updateprofile');
});

require __DIR__.'/auth.php';
