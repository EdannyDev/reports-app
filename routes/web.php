<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\UserProfileController;  // Asegúrate de importar el controlador
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Models\Report;

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
    $reports = Report::all();  // Obtén todos los reportes
    return view('reports.index', compact('reports'));  // Apuntamos a reports/index.blade.php
})->name('home');

// Agrupación de rutas protegidas
Route::middleware('auth')->group(function () {
    // Rutas de reportes (usando resource para simplificar)
    Route::resource('reports', ReportController::class);

    // Rutas de áreas
    Route::resource('areas', AreaController::class);

    // Ruta del perfil del usuario
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
        Route::put('/profile', [UserProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [UserProfileController::class, 'delete'])->name('profile.delete'); // Ruta para eliminar cuenta
    });
});
