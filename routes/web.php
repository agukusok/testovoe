<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('register');
})->name('register');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [UserController::class, 'login'])->name('login.submit');

Route::get('/update', [UserController::class, 'showUpdateForm'])->name('update');

Route::get('/user', [UserController::class, 'showProfile'])->name('user');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::delete('/user', [UserController::class, 'deleteUser'])->name('user.delete');

Route::group([
    'prefix' => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', 'admin'],
    'namespace' => 'App\Http\Controllers\Admin',
], function () {
    Route::get('/dashboard', 'AdminDashboardController@index')->name('backpack.dashboard');
});

Route::resource('admin/users', UserAdminController::class)->middleware('auth');

