<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\UserAdminController;


Route::middleware('api')->group(function () {
    Route::post('register', [UserController::class, 'register'])->name('api.register');
    Route::post('login', [UserController::class, 'login'])->name('api.login');

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('user', [UserController::class, 'getUserInfo'])->name('api.getUserInfo'); // Получение информации о пользователе
        Route::put('user/update', [UserController::class, 'updateUser'])->name('api.updateUser'); // Обновление пользователя
        Route::delete('user', [UserController::class, 'deleteUser'])->name('api.deleteUser'); // Удаление пользователя
    });
});

// Ресурсные маршруты для админов
Route::resource('admin/users', UserAdminController::class);
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('users', [UserAdminController::class, 'index'])->name('users.index');
    Route::get('users/create', [UserAdminController::class, 'create'])->name('users.create');
    Route::post('users', [UserAdminController::class, 'store'])->name('users.store');
    Route::get('users/{user}/edit', [UserAdminController::class, 'edit'])->name('users.edit');

    // Один маршрут для обновления
    Route::put('users/{user}', [UserAdminController::class, 'update'])->name('users.update');

    // Второй маршрут для обновления, но с другим именем
    Route::put('users/{user}/update-user', [UserAdminController::class, 'updateUser'])->name('users.updateUser');

    Route::delete('users/{user}', [UserAdminController::class, 'destroy'])->name('users.destroy');
});
