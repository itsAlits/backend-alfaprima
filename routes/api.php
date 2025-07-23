<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MatakuliahController;

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


// Protected routes All Roles
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/mahasiswa', [UserController::class, 'getMahasiswa']);
    Route::get('/dosen', [UserController::class, 'getDosen']);
    Route::get('/matakuliah', [MatakuliahController::class, 'GetAllMatkul']);
    Route::put('/users/{id}', [UserController::class, 'updateUser']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});


// Protected routes for Dosen only
Route::middleware(['auth:sanctum', 'role:Dosen'])->group(function () {
    // User management routes
    Route::get('/users', [UserController::class, 'getAllUser']);
    Route::delete('/users/{id}', [UserController::class, 'deleteUser']);

    // Matkul Routes
    Route::get('/matakuliah/{id}', [MatakuliahController::class, 'GetMatkul']);
    Route::post('/matakuliah', [MatakuliahController::class, 'CreateMatkul']);
    Route::put('/matakuliah/{id}', [MatakuliahController::class, 'EditMatkul']);
    Route::delete('/matakuliah/{id}', [MatakuliahController::class, 'DeleteMatkul']);
});
