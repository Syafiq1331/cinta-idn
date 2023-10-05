<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\MahasiswaController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/feedback', [FeedbackController::class, 'index']);
Route::post('/feedback', [FeedbackController::class, 'store']);
Route::put('/feedback/{id}', [FeedbackController::class, 'update']);

Route::post('/mahasiswa/register', [MahasiswaController::class, 'register']);
Route::get('/mahasiswa', [MahasiswaController::class, 'index']);
Route::get('/mahasiswa/{id}', [MahasiswaController::class, 'show']);
Route::put('/mahasiswa/{id}', [MahasiswaController::class, 'update']);
Route::delete('/mahasiswa/{id}', [MahasiswaController::class, 'destroy']);
