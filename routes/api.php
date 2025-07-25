<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\KrsController;
use App\Http\Controllers\KelasController;

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


// Protected routes All Roles
Route::middleware('auth:sanctum')->group(function () {

    // users
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/mahasiswa', [UserController::class, 'getMahasiswa']);
    Route::get('/dosen', [UserController::class, 'getDosen']);
    Route::put('/users/{id}', [UserController::class, 'updateUser']);
    
    
    // matkul
    Route::get('/matakuliah', [MatakuliahController::class, 'GetAllMatkul']);
    
    
    Route::get('/kelas', [KelasController::class, 'GetAllKelas']);
    
    Route::get('/krs', [KrsController::class, 'GetAllKrs']);
    // KRS
    Route::get('/krs/{id}/{tahunAkademik}', [KrsController::class, 'getKrsByUserIdAndTahunAkademik']);
    Route::get('/krs/{id}', [KrsController::class, 'getKrsByUserId']);
    Route::post('/krs', [KrsController::class, 'CreateKrs']);
    Route::delete('/krs/{id}', [KrsController::class, 'DeleteKrsByUserId']);
    
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});


// Protected routes for Dosen only
Route::middleware(['auth:sanctum', 'role:Dosen'])->group(function () {
    
    // User routes
    Route::get('/users', [UserController::class, 'getAllUser']);
    Route::delete('/users/{id}', [UserController::class, 'deleteUser']);
    
    // Matkul Routes
    Route::get('/matakuliah/{id}', [MatakuliahController::class, 'GetMatkul']);
    Route::post('/matakuliah', [MatakuliahController::class, 'CreateMatkul']);
    Route::put('/matakuliah/{id}', [MatakuliahController::class, 'EditMatkul']);
    Route::delete('/matakuliah/{id}', [MatakuliahController::class, 'DeleteMatkul']);

    //kelas
    Route::get('/kelas/{id}', [KelasController::class, 'GetKelas']);
    Route::post('/kelas', [KelasController::class, 'CreateKelas']);
    Route::put('/kelas/{id}', [KelasController::class, 'EditKelas']);
    Route::delete('/kelas/{id}', [KelasController::class, 'DeleteKelas']);

    // KRS Routes for Dosen
    Route::put('/krs/{id}', [KrsController::class, 'editKrsByUserIdForDosen']);
});
