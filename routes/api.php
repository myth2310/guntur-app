<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\FasilitasController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Route::get('/',function(){
//     return response()->json([
//         'status' => false,
//         'message' => 'Tidak memiliki akses'
//     ],401);
// })->name('login');
// Users

Route::get('/users', [UserController::class, 'index']);
Route::post('/users/{id}', [UserController::class, 'update']);
Route::get('/users/{id}', [UserController::class, 'show']);

// Facility
Route::get('/facility', [FasilitasController::class, 'index']);
Route::post('/facility', [FasilitasController::class, 'store']);
Route::get('/facility/{id}', [FasilitasController::class, 'show']);
Route::put('/facility/{id}', [FasilitasController::class, 'update']);
Route::delete('/facility/{id}', [FasilitasController::class, 'destroy']);