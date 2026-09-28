<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Rutas de autenticación
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
});

// Ruta de logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Ruta de inicio después del login
Route::middleware('auth')->get('/', function () {
    return redirect()->route('reports.index');
})->name('home');

// Agrupación de rutas protegidas
Route::middleware('auth')->group(function () {
    Route::resource('reports', ReportController::class);

    Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
    Route::put('/profile', [UserProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [UserProfileController::class, 'delete'])->name('profile.delete');

    // Solo accesibles por admin (middleware 'admin' registrada en bootstrap/app.php)
    Route::middleware('admin')->group(function () {
        Route::resource('areas', AreaController::class);
        Route::get('/users', [UserManagementController::class, 'index'])->name('users.index');
        Route::put('/users/{user}/role', [UserManagementController::class, 'updateRole'])->name('users.updateRole');
    });
});